new DataTable("#example");
$(document).ready(function () {
  var table = $("#example").DataTable({
    lengthChange: false,
    buttons: ["colvis"],
    language: {
      paginate: {
        previous: "‹",
        next: "›",
      },
      aria: {
        paginate: {
          previous: "Previous",
          next: "Next",
        },
      },
    },
  });

  table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
});
