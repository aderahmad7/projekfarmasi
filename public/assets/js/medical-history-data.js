// Global variables
const cardsPerPage = 2;
let currentPage = 1;
const cards = document.querySelectorAll(".medical-history-data");
let filteredCards = [...cards]; // Start with all cards
const totalPages = Math.ceil(cards.length / cardsPerPage);

// Date filtering function
function filterCardsByDate() {
    const startDateStr = document.getElementById('startDate').value;
    const endDateStr = document.getElementById('endDate').value;
    
    if (!startDateStr && !endDateStr) {
        filteredCards = [...cards];
    } else {
        const startDate = startDateStr ? new Date(startDateStr) : new Date(0);
        const endDate = endDateStr ? new Date(endDateStr) : new Date('9999-12-31');
        
        filteredCards = [...cards].filter(card => {
            const cardDate = new Date(card.getAttribute('data-tanggal'));
            return cardDate >= startDate && cardDate <= endDate;
        });
    }
    
    currentPage = 1; // Reset to first page after filtering
    showCards(currentPage);
    setupPagination();
}

// Modify showCards function to use filteredCards
function showCards(page) {
    const startIndex = (page - 1) * cardsPerPage;
    const endIndex = startIndex + cardsPerPage;

    cards.forEach(card => card.classList.add("hidden"));
    
    filteredCards.slice(startIndex, endIndex).forEach(card => {
        card.classList.remove("hidden");
    });
}

// Update setupPagination to use filteredCards length
function setupPagination() {
    const paginationContainer = document.getElementById("pagination");
    paginationContainer.innerHTML = "";

    const totalFilteredPages = Math.ceil(filteredCards.length / cardsPerPage);

    const createPageButton = (page) => {
        const button = document.createElement("button");
        button.innerText = page;
        button.addEventListener("click", () => {
            currentPage = page;
            showCards(currentPage);
            setupPagination();
        });
        if (page === currentPage) {
            button.classList.add("active");
        }
        return button;
    };

    const createEllipsis = () => {
        const span = document.createElement("span");
        span.className = "ellipsis";
        span.innerText = "...";
        return span;
    };

    paginationContainer.appendChild(createPageButton(1));

    if (currentPage > 3) {
        paginationContainer.appendChild(createEllipsis());
    }

    for (
        let i = Math.max(2, currentPage - 1);
        i <= Math.min(totalFilteredPages - 1, currentPage + 1);
        i++
    ) {
        paginationContainer.appendChild(createPageButton(i));
    }

    if (currentPage < totalFilteredPages - 2) {
        paginationContainer.appendChild(createEllipsis());
    }

    if (totalFilteredPages > 1) {
        paginationContainer.appendChild(createPageButton(totalFilteredPages));
    }
}

// Initialize flatpickr for startDate
const startDate = flatpickr("#startDate", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
        endDate.set("minDate", dateStr);
        filterCardsByDate();
    },
});

// Initialize flatpickr for endDate
const endDate = flatpickr("#endDate", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
        startDate.set("maxDate", dateStr);
        filterCardsByDate();
    },
});

// Initial setup
showCards(currentPage);
setupPagination();