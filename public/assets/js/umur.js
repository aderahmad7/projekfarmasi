const umur = flatpickr("#tanggal-lahir", {
  dateFormat: "Y-m-d",
  onChange: function (selectedDates, dateStr, instance) {
    endDate.set("minDate", dateStr);
    filterCardsByDate();
  },
  static: true,
});
