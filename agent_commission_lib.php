<?php

function agent_commission_column_exists($con, $table, $column) {
    $stmt = $con->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? AND COLUMN_NAME=?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ss", $table, $column);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $exists;
}

function agent_commission_table_exists($con, $table) {
    $stmt = $con->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("s", $table);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $exists;
}

function agent_commission_add_column_if_missing($con, $table, $column, $alterSql) {
    if (agent_commission_table_exists($con, $table) && !agent_commission_column_exists($con, $table, $column)) {
        $con->query($alterSql);
    }
}

function agent_commission_index_exists($con, $table, $index) {
    $stmt = $con->prepare("SELECT INDEX_NAME FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? AND INDEX_NAME=?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ss", $table, $index);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $exists;
}

function agent_commission_add_index_if_missing($con, $table, $index, $alterSql) {
    if (agent_commission_table_exists($con, $table) && !agent_commission_index_exists($con, $table, $index)) {
        $con->query($alterSql);
    }
}

function agent_commission_ensure_schema($con) {
    agent_commission_add_column_if_missing($con, 'agent_customers', 'registered_user_id', "ALTER TABLE agent_customers ADD COLUMN registered_user_id INT DEFAULT NULL AFTER customer_id");
    agent_commission_add_column_if_missing($con, 'agent_customers', 'registered_matri_id', "ALTER TABLE agent_customers ADD COLUMN registered_matri_id VARCHAR(80) DEFAULT NULL AFTER registered_user_id");
    agent_commission_add_column_if_missing($con, 'agent_customers', 'updated_at', "ALTER TABLE agent_customers ADD COLUMN updated_at DATETIME NULL DEFAULT NULL");
    agent_commission_add_column_if_missing($con, 'agent_customers', 'linked_at', "ALTER TABLE agent_customers ADD COLUMN linked_at DATETIME DEFAULT NULL AFTER updated_at");
    agent_commission_add_index_if_missing($con, 'agent_customers', 'idx_agent_customer_email', "ALTER TABLE agent_customers ADD INDEX idx_agent_customer_email (customer_email)");
    agent_commission_add_index_if_missing($con, 'agent_customers', 'idx_agent_customer_registered_user', "ALTER TABLE agent_customers ADD INDEX idx_agent_customer_registered_user (registered_user_id)");
    agent_commission_add_index_if_missing($con, 'agent_customers', 'idx_agent_customer_registered_matri', "ALTER TABLE agent_customers ADD INDEX idx_agent_customer_registered_matri (registered_matri_id)");

    agent_commission_add_column_if_missing($con, 'agent_sales', 'agent_customer_id', "ALTER TABLE agent_sales ADD COLUMN agent_customer_id INT DEFAULT NULL AFTER agent_id");
    agent_commission_add_column_if_missing($con, 'agent_sales', 'commission_source', "ALTER TABLE agent_sales ADD COLUMN commission_source VARCHAR(80) NOT NULL DEFAULT 'Manual Customer Purchase' AFTER sale_status");
    agent_commission_add_column_if_missing($con, 'agent_sales', 'payment_reference_id', "ALTER TABLE agent_sales ADD COLUMN payment_reference_id VARCHAR(120) DEFAULT NULL AFTER commission_source");
    agent_commission_add_index_if_missing($con, 'agent_sales', 'idx_agent_sales_customer', "ALTER TABLE agent_sales ADD INDEX idx_agent_sales_customer (agent_customer_id)");
    agent_commission_add_index_if_missing($con, 'agent_sales', 'idx_agent_sales_payment_ref', "ALTER TABLE agent_sales ADD INDEX idx_agent_sales_payment_ref (payment_reference_id)");

    agent_commission_add_column_if_missing($con, 'agent_commissions', 'commission_source', "ALTER TABLE agent_commissions ADD COLUMN commission_source VARCHAR(80) NOT NULL DEFAULT 'Manual Customer Purchase' AFTER commission_amount");
    agent_commission_add_column_if_missing($con, 'agent_commissions', 'payment_reference_id', "ALTER TABLE agent_commissions ADD COLUMN payment_reference_id VARCHAR(120) DEFAULT NULL AFTER commission_source");
}

function agent_commission_normalize_mobile($mobile) {
    $digits = preg_replace('/\D+/', '', (string)$mobile);
    if (strlen($digits) > 10) {
        $digits = substr($digits, -10);
    }
    return $digits;
}

function agent_link_registered_customer($con, $registeredUserId, $matriId, $mobile, $email) {
    agent_commission_ensure_schema($con);
    $registeredUserId = (int)$registeredUserId;
    $matriId = trim((string)$matriId);
    $email = strtolower(trim((string)$email));
    $mobile = agent_commission_normalize_mobile($mobile);

    if ($registeredUserId <= 0 && $matriId === '') {
        return 0;
    }
    if ($email === '' && $mobile === '') {
        return 0;
    }

    $matched = agent_find_agent_customer_for_user($con, $registeredUserId, $matriId, $mobile, $email);
    if (!$matched) {
        return 0;
    }

    $customerId = (int)$matched['customer_id'];
    $stmt = $con->prepare("UPDATE agent_customers SET registered_user_id=?, registered_matri_id=?, linked_at=IF(linked_at IS NULL, NOW(), linked_at), updated_at=NOW() WHERE customer_id=?");
    if ($stmt) {
        $stmt->bind_param("isi", $registeredUserId, $matriId, $customerId);
        $stmt->execute();
        $stmt->close();
    }

    return $customerId;
}

function agent_find_agent_customer_for_user($con, $registeredUserId, $matriId, $mobile, $email) {
    agent_commission_ensure_schema($con);
    $registeredUserId = (int)$registeredUserId;
    $matriId = trim((string)$matriId);
    $email = strtolower(trim((string)$email));
    $mobile = agent_commission_normalize_mobile($mobile);

    $where = array();
    $types = '';
    $params = array();

    if ($registeredUserId > 0) {
        $where[] = "c.registered_user_id=?";
        $types .= 'i';
        $params[] = $registeredUserId;
    }
    if ($matriId !== '') {
        $where[] = "c.registered_matri_id=?";
        $types .= 's';
        $params[] = $matriId;
    }
    if ($mobile !== '') {
        $where[] = "RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.customer_mobile, ' ', ''), '-', ''), '+', ''), '(', ''), ')', ''), 10)=?";
        $types .= 's';
        $params[] = $mobile;
    }
    if ($email !== '') {
        $where[] = "LOWER(c.customer_email)=?";
        $types .= 's';
        $params[] = $email;
    }

    if (!$where) {
        return null;
    }

    $sql = "SELECT c.*
        FROM agent_customers c
        INNER JOIN agents a ON a.agent_id=c.agent_id AND a.status='Active'
        WHERE (" . implode(' OR ', $where) . ")
        ORDER BY
            CASE WHEN c.registered_user_id=? THEN 0 WHEN c.registered_matri_id=? THEN 1 ELSE 2 END,
            c.customer_id DESC
        LIMIT 1";
    $types .= 'is';
    $params[] = $registeredUserId;
    $params[] = $matriId;

    $stmt = $con->prepare($sql);
    if (!$stmt) {
        return null;
    }
    $bindParams = array_merge(array($types), $params);
    $refs = array();
    foreach ($bindParams as $key => $value) {
        $refs[$key] = &$bindParams[$key];
    }
    call_user_func_array(array($stmt, 'bind_param'), $refs);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row ?: null;
}

function agent_has_prior_commission_sale($con, $agentId, $matriId, $customerMobile, $customerEmail, $saleReference = '') {
    $agentId = (int)$agentId;
    $matriId = trim((string)$matriId);
    $mobile = agent_commission_normalize_mobile($customerMobile);
    $email = strtolower(trim((string)$customerEmail));
    $saleReference = trim((string)$saleReference);

    if ($agentId <= 0) {
        return false;
    }

    $where = array();
    $types = 'i';
    $params = array($agentId);

    if ($matriId !== '') {
        $where[] = "customer_matri_id=?";
        $types .= 's';
        $params[] = $matriId;
    }
    if ($mobile !== '') {
        $where[] = "RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(customer_mobile, ' ', ''), '-', ''), '+', ''), '(', ''), ')', ''), 10)=?";
        $types .= 's';
        $params[] = $mobile;
    }
    if ($email !== '') {
        $where[] = "LOWER(customer_email)=?";
        $types .= 's';
        $params[] = $email;
    }

    if (!$where) {
        return false;
    }

    $sql = "SELECT sale_id FROM agent_sales WHERE agent_id=? AND (" . implode(' OR ', $where) . ")";
    if ($saleReference !== '') {
        $sql .= " AND sale_reference<>?";
        $types .= 's';
        $params[] = $saleReference;
    }
    $sql .= " LIMIT 1";

    $stmt = $con->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $bindParams = array_merge(array($types), $params);
    $refs = array();
    foreach ($bindParams as $key => $value) {
        $refs[$key] = &$bindParams[$key];
    }
    call_user_func_array(array($stmt, 'bind_param'), $refs);
    $stmt->execute();
    $hasPrior = $stmt->get_result()->num_rows > 0;
    $stmt->close();

    return $hasPrior;
}

function agent_commission_source_by_history($con, $agentId, $matriId, $customerMobile, $customerEmail, $saleReference = '') {
    return agent_has_prior_commission_sale($con, $agentId, $matriId, $customerMobile, $customerEmail, $saleReference)
        ? 'Renew Plan Commission'
        : 'Manual Customer Purchase';
}

function agent_create_commission_for_sale_shared($con, $saleReference, $matriId, $customerName, $customerMobile, $customerEmail, $agentId, $planName, $planAmount, $saleDate, $options = array()) {
    agent_commission_ensure_schema($con);
    $agentId = (int)$agentId;
    if ($agentId <= 0 || trim((string)$saleReference) === '') {
        return false;
    }

    $planId = isset($options['plan_id']) ? (int)$options['plan_id'] : 0;
    if ($planId <= 0) {
        $stmt = $con->prepare("SELECT planid FROM membershipplan WHERE plandisplayname=? OR planname=? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("ss", $planName, $planName);
            $stmt->execute();
            if ($row = $stmt->get_result()->fetch_assoc()) {
                $planId = (int)$row['planid'];
            }
            $stmt->close();
        }
    }
    if ($planId <= 0) {
        return false;
    }

    $stmt = $con->prepare("SELECT commission_percentage FROM agent_plan_assignments WHERE agent_id=? AND plan_id=? AND status='Active' LIMIT 1");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ii", $agentId, $planId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$row) {
        return false;
    }

    $commissionPercentage = (float)$row['commission_percentage'];
    $saleDateSql = date('Y-m-d', strtotime($saleDate));
    $eligibleDate = date('Y-m-d', strtotime($saleDateSql . ' +30 days'));
    $planAmount = (float)$planAmount;
    $commissionAmount = round(($planAmount * $commissionPercentage) / 100, 2);
    $paymentStatus = 'Clear';
    $saleStatus = 'Confirmed';
    $commissionSource = trim((string)($options['commission_source'] ?? ''));
    if ($commissionSource === '' || !empty($options['auto_source_by_history'])) {
        $commissionSource = agent_commission_source_by_history($con, $agentId, $matriId, $customerMobile, $customerEmail, $saleReference);
    }
    $paymentReferenceId = trim((string)($options['payment_reference_id'] ?? $saleReference));
    $agentCustomerId = (int)($options['agent_customer_id'] ?? 0);

    $stmt = $con->prepare("INSERT IGNORE INTO agent_sales (sale_reference, customer_matri_id, customer_name, customer_mobile, customer_email, agent_id, agent_customer_id, plan_id, plan_name, plan_amount, payment_status, sale_status, commission_source, payment_reference_id, sale_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("sssssiiisdsssss", $saleReference, $matriId, $customerName, $customerMobile, $customerEmail, $agentId, $agentCustomerId, $planId, $planName, $planAmount, $paymentStatus, $saleStatus, $commissionSource, $paymentReferenceId, $saleDateSql);
    $stmt->execute();
    $stmt->close();

    $stmt = $con->prepare("SELECT sale_id FROM agent_sales WHERE sale_reference=? LIMIT 1");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("s", $saleReference);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$row) {
        return false;
    }
    $saleId = (int)$row['sale_id'];
    $status = (strtotime($eligibleDate) <= strtotime(date('Y-m-d'))) ? 'Eligible' : 'On Hold';

    $stmt = $con->prepare("INSERT IGNORE INTO agent_commissions (sale_id, agent_id, plan_id, sale_date, commission_percentage, commission_amount, commission_source, payment_reference_id, commission_status, eligible_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("iiisddssss", $saleId, $agentId, $planId, $saleDateSql, $commissionPercentage, $commissionAmount, $commissionSource, $paymentReferenceId, $status, $eligibleDate);
    $stmt->execute();
    $stmt->close();

    return true;
}

function agent_create_commission_for_registered_payment($con, $member, $plan, $amount, $saleReference, $paymentReferenceId, $commissionSource, $saleDate) {
    $registeredUserId = (int)($member['ID'] ?? 0);
    $matriId = (string)($member['MatriID'] ?? '');
    $mobile = (string)($member['Mobile'] ?? '');
    $email = (string)($member['ConfirmEmail'] ?? '');
    $customer = agent_find_agent_customer_for_user($con, $registeredUserId, $matriId, $mobile, $email);
    if (!$customer) {
        return false;
    }

    agent_link_registered_customer($con, $registeredUserId, $matriId, $mobile, $email);

    $planName = (string)($plan['plandisplayname'] ?? $plan['planname'] ?? '');
    $planId = (int)($plan['planid'] ?? 0);
    $created = agent_create_commission_for_sale_shared(
        $con,
        $saleReference,
        $matriId,
        (string)($member['Name'] ?? $customer['customer_name']),
        $mobile,
        $email,
        (int)$customer['agent_id'],
        $planName,
        $amount,
        $saleDate,
        array(
            'plan_id' => $planId,
            'commission_source' => $commissionSource,
            'payment_reference_id' => $paymentReferenceId,
            'agent_customer_id' => (int)$customer['customer_id'],
            'auto_source_by_history' => true
        )
    );

    if ($created) {
        $stmt = $con->prepare("UPDATE agent_customers SET customer_status='Purchased', plan_id=?, plan_name=?, updated_at=NOW() WHERE customer_id=?");
        if ($stmt) {
            $customerId = (int)$customer['customer_id'];
            $stmt->bind_param("isi", $planId, $planName, $customerId);
            $stmt->execute();
            $stmt->close();
        }
    }

    return $created;
}
