<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Only GET allowed
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only GET requests are allowed"]);
    exit;
}

try {
    // Define questions and their options statically since they are not stored in the database
    $questions = [
        [
            "id" => 1,
            "question" => "How often do you go out",
            "type" => "radio",
            "options" => [
                ["id" => 1, "value" => "Twice a week or more than that"],
                ["id" => 2, "value" => "Once a week"],
                ["id" => 3, "value" => "Twice in a month"],
                ["id" => 4, "value" => "Once a month or less"]
            ]
        ],
        [
            "id" => 2,
            "question" => "How would you describe your clothes?",
            "type" => "radio",
            "options" => [
                ["id" => 5, "value" => "Only of foreign or big brands"],
                ["id" => 6, "value" => "Mostly all foreign brands"],
                ["id" => 7, "value" => "Mostly all of local brands"],
                ["id" => 8, "value" => "All of local brands"]
            ]
        ],
        [
            "id" => 3,
            "question" => "How do you spend your free time",
            "type" => "checkbox",
            "options" => [
                ["id" => 9, "value" => "Meditation, Satsang etc"],
                ["id" => 10, "value" => "Family"],
                ["id" => 11, "value" => "Hobbies/ recreational activities"],
                ["id" => 12, "value" => "Friends"]
            ]
        ],
        [
            "id" => 4,
            "question" => "How many times do you visit salon/beauty parlour?",
            "type" => "radio",
            "options" => [
                ["id" => 13, "value" => "Weekly once"],
                ["id" => 14, "value" => "Twice in a month"],
                ["id" => 15, "value" => "Once in a month"],
                ["id" => 16, "value" => "Once in a while"]
            ]
        ],
        [
            "id" => 5,
            "question" => "How many times do you go out drinking/in a pub",
            "type" => "radio",
            "options" => [
                ["id" => 17, "value" => "Once a week or more"],
                ["id" => 18, "value" => "Once/twice in a month"],
                ["id" => 19, "value" => "Rarely"],
                ["id" => 20, "value" => "Never"]
            ]
        ],
        [
            "id" => 6,
            "question" => "What would you choose for a romantic date with your partner?",
            "type" => "radio",
            "options" => [
                ["id" => 21, "value" => "Candle light dinner at home"],
                ["id" => 22, "value" => "Lunch/dinner in a deluxe hotel"],
                ["id" => 23, "value" => "Long drive"],
                ["id" => 24, "value" => "Tea and snacks at a street vendor"]
            ]
        ],
        [
            "id" => 7,
            "question" => "Which social platform do you use most",
            "type" => "checkbox",
            "options" => [
                ["id" => 25, "value" => "Facebook"],
                ["id" => 26, "value" => "What'sapp"],
                ["id" => 27, "value" => "Instagram"],
                ["id" => 28, "value" => "Twitter"]
            ]
        ],
        [
            "id" => 8,
            "question" => "Do you like shopping?",
            "type" => "radio",
            "options" => [
                ["id" => 29, "value" => "Yes"],
                ["id" => 30, "value" => "Sometimes"],
                ["id" => 31, "value" => "Only when it’s needed"],
                ["id" => 32, "value" => "No"]
            ]
        ],
        [
            "id" => 9,
            "question" => "Preferences while traveling?",
            "type" => "radio",
            "options" => [
                ["id" => 33, "value" => "No problem wherever or whenever"],
                ["id" => 34, "value" => "Trekking/ adventurous activities"],
                ["id" => 35, "value" => "Serene, places close to nature"],
                ["id" => 36, "value" => "Don’t like to travel"]
            ]
        ],
        [
            "id" => 10,
            "question" => "Which personality are you?",
            "type" => "radio",
            "options" => [
                ["id" => 37, "value" => "I like to spend a lot, on luxury products"],
                ["id" => 38, "value" => "I like luxury products sometimes"],
                ["id" => 39, "value" => "Not for luxury, but prefer to spend for convenience"],
                ["id" => 40, "value" => "Tendency for low cost and economical choices"]
            ]
        ]
    ];

    echo json_encode([
        "status"  => "success",
        "message" => "Questions and options fetched successfully",
        "data"    => $questions
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>