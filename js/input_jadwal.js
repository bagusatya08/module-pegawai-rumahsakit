function toggle_target(source) {
    checkboxes = document.getElementsByClassName("target_jadwal");
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}
