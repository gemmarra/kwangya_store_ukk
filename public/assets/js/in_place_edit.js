$(document).ready(function () {
  $(".btn-edit").on("click", function (e) {
    e.preventDefault();
    var row = $(this).closest("tr");
    var editableField = row.find(".editable");
    editableField.attr("contenteditable", "true").focus();
    row.find(".btn-save").removeClass("d-none");
  });

  $(".btn-save").on("click", function () {
    var row = $(this).closest("tr");
    var editedText = row.find(".editable").text();
    var categoryId = row.find(".editable").data("category-id");
    // AJAX request to update the category name
    $.ajax({
      url: "/category/update", // Update the URL to match your controller method
      type: "post",
      data: { category_id: categoryId, category_name: editedText },
      success: function (response) {
        console.log("Category name updated:", editedText);
        // Once saved, disable editing mode and hide save button
        row.find(".editable").attr("contenteditable", "false");
        row.find(".btn-save").addClass("d-none");
      },
    });
  });
});
