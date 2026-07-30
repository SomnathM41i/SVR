(function () {
  'use strict';

  var customWidgetSelector = [
    '.mvv-multiselect',
    '.mvv-multi-wrap',
    '.mvv-msel',
    '.advance-search-form .mvv-multiselect'
  ].join(',');

  function closeAll(except) {
    document.querySelectorAll('.mvv-searchable-multi.is-open').forEach(function (wrapper) {
      if (wrapper === except) return;
      wrapper.classList.remove('is-open');
      wrapper.querySelector('.mvv-searchable-multi__toggle').setAttribute('aria-expanded', 'false');
    });
  }

  function enhance(select, index) {
    if (select.dataset.searchableMultiReady === 'true') return;
    if (
      select.classList.contains('selectpicker') ||
      select.classList.contains('bs-select-hidden') ||
      select.classList.contains('mvv-multiselect-source') ||
      select.classList.contains('mvv-multi-source') ||
      select.classList.contains('education-multiselect') ||
      select.dataset.searchableMulti === 'off' ||
      select.closest(customWidgetSelector) ||
      select.closest('.bootstrap-select, .multiselect-native-select') ||
      window.getComputedStyle(select).display === 'none'
    ) return;

    select.dataset.searchableMultiReady = 'true';

    var wrapper = document.createElement('div');
    wrapper.className = 'mvv-searchable-multi';
    var toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'mvv-searchable-multi__toggle';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-haspopup', 'listbox');
    var text = document.createElement('span');
    text.className = 'mvv-searchable-multi__text';
    toggle.appendChild(text);

    var menu = document.createElement('div');
    menu.className = 'mvv-searchable-multi__menu';
    menu.setAttribute('role', 'listbox');
    menu.setAttribute('aria-multiselectable', 'true');

    var searchWrap = document.createElement('div');
    searchWrap.className = 'mvv-searchable-multi__search-wrap';
    var search = document.createElement('input');
    search.type = 'search';
    search.className = 'mvv-searchable-multi__search';
    search.placeholder = 'Search options...';
    search.setAttribute('aria-label', 'Search options');
    searchWrap.appendChild(search);
    menu.appendChild(searchWrap);

    var empty = document.createElement('div');
    empty.className = 'mvv-searchable-multi__empty';
    empty.textContent = 'No matching options';

    function updateText() {
      var selected = Array.prototype.filter.call(select.options, function (option) {
        return option.selected;
      });
      var placeholder = select.getAttribute('title') || select.dataset.placeholder || 'Select options';
      if (!selected.length) {
        text.textContent = placeholder;
      } else if (selected.length > 2) {
        text.textContent = selected.length + ' selected';
      } else {
        text.textContent = selected.map(function (option) { return option.text; }).join(', ');
      }
    }

    Array.prototype.forEach.call(select.options, function (option, optionIndex) {
      var label = document.createElement('label');
      label.className = 'mvv-searchable-multi__option';
      if (option.selected) label.classList.add('is-selected');
      var checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.checked = option.selected;
      checkbox.disabled = option.disabled;
      checkbox.id = 'mvv_searchable_' + index + '_' + optionIndex;
      var name = document.createElement('span');
      name.textContent = option.text;
      checkbox.addEventListener('change', function () {
        option.selected = checkbox.checked;
        label.classList.toggle('is-selected', checkbox.checked);
        updateText();
        select.dispatchEvent(new Event('change', { bubbles: true }));
      });
      label.appendChild(checkbox);
      label.appendChild(name);
      menu.appendChild(label);
    });
    menu.appendChild(empty);

    select.parentNode.insertBefore(wrapper, select);
    wrapper.appendChild(select);
    wrapper.appendChild(toggle);
    wrapper.appendChild(menu);

    toggle.addEventListener('click', function (event) {
      event.stopPropagation();
      var willOpen = !wrapper.classList.contains('is-open');
      closeAll(wrapper);
      wrapper.classList.toggle('is-open', willOpen);
      toggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
      if (willOpen) window.setTimeout(function () { search.focus(); }, 0);
    });
    menu.addEventListener('click', function (event) {
      event.stopPropagation();
    });
    search.addEventListener('input', function () {
      var query = search.value.trim().toLocaleLowerCase();
      var visible = 0;
      menu.querySelectorAll('.mvv-searchable-multi__option').forEach(function (label) {
        var matches = !query || label.textContent.toLocaleLowerCase().indexOf(query) !== -1;
        label.style.display = matches ? '' : 'none';
        if (matches) visible++;
      });
      empty.style.display = visible ? 'none' : 'block';
    });
    search.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        wrapper.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
      }
    });
    updateText();
  }

  window.addEventListener('load', function () {
    document.querySelectorAll('select[multiple]').forEach(enhance);
  });
  document.addEventListener('click', function () {
    closeAll();
  });
})();
