document.addEventListener('DOMContentLoaded', function () {
    new TomSelect("#client_id", {
        create: false,
        sortField: { field: "text", direction: "asc" },
        placeholder: "Search client name...",
    });
});