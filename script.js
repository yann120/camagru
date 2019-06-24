function activateModal($id) {
    $modalid = "modal" + $id;
    document.getElementById($modalid).className = "modal is-active";
}

function desactivateModal($id) {
    $modalid = "modal" + $id;
    document.getElementById($modalid).className = "modal";
}