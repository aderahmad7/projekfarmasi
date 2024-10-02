const startDate = flatpickr("#startDate", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
        // Set the minDate for endDate after startDate is selected
        endDate.set("minDate", dateStr);
        console.log('Start date selected:', dateStr);
    },
});

// Initialize flatpickr for endDate
const endDate = flatpickr("#endDate", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
        // Set the maxDate for startDate after endDate is selected
        startDate.set("maxDate", dateStr);
        console.log('End date selected:', dateStr);
    },
});