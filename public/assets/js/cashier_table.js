// Add this script in your view file or in a separate JS file
function submitForm() {
  var formData = $("#myForm").serialize();

  $.ajax({
    url: "/selling/add_list", // Replace 'controller/processFormData' with your actual route
    type: "POST",
    data: formData,
    success: function (response) {
      // Update table with new data
      $("#dataTable tbody").append(
        "<tr><td>" + response.name + "</td><td>" + response.email + "</td></tr>"
      );

      // Clear form fields
      $("#myForm")[0].reset();
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}
