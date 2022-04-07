$(function() {
  $('input[name="data_inicio"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2000
  });
  $('input[name="data_fim"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2000
  });
});
