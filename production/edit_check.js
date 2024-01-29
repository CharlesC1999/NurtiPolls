function fillModal(element) {
    var id = element.getAttribute('data-id');
    var name = element.getAttribute('data-name');
    var description = element.getAttribute('data-description');

    document.getElementById('categoryName').value = name;
    document.getElementById('categoryDescription').value = description;
    document.getElementById('id').value = id;

    var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
    myModal.show();
}

function confirmSave() {
    var confirmSave = confirm("請問是否確認修改？");
    if (confirmSave) {
        // 確定，提交
        document.getElementById('editCategoryForm').submit();
    } else {
        // 取消，維持原窗口
    }
}