// function changeColorLikeButton($id) {
//     $class = document.getElementById($id).className;
//     if ($class.includes("has-background-link has-text-white"))
//         document.getElementById($id).className = "card-footer-item";
//     else
//         document.getElementById($id).className = "card-footer-item has-background-link has-text-white";
// }

function activateModal($id) {
    $modalid = "modal" + $id;
    document.getElementById($modalid).className = "modal is-active";
}

function desactivateModal($id) {
    $modalid = "modal" + $id;
    document.getElementById($modalid).className = "modal";
}