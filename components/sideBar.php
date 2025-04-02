<div class="flex w-1/6 bg-gray-100 h-full flex-col rounded-2xl p-6">
    <form id="filterForm">
        <div class="rounded flex text-center items-center">
            <input type="text" id="searchInput" placeholder="Intitulé" class="w-full h-full z-10 outline-none bg-transparent text-xl">
            <svg class="w-5 h-full z-10" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="m19.485 20.154l-6.262-6.262q-.75.639-1.725.989t-1.96.35q-2.402 0-4.066-1.663T3.808 9.503T5.47 5.436t4.064-1.667t4.068 1.664T15.268 9.5q0 1.042-.369 2.017t-.97 1.668l6.262 6.261zM9.539 14.23q1.99 0 3.36-1.37t1.37-3.361t-1.37-3.36t-3.36-1.37t-3.361 1.37t-1.37 3.36t1.37 3.36t3.36 1.37"/>
            </svg>
        </div>
        <button type="button" id="submitButton" class="w-full py-2 bg-yellow-500 border-2 border-yellow-500 my-6 rounded text-center">
            Appliquer
        </button>
        <hr class="w-full border-2 border-gray-400 my-6">
        <div class="w-full flex flex-col rounded my-2">
            <select id="dateFilter" class="my-2 appearance-none w-full py-2 px-4 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none">
                <option value="1">Date</option>
                <option value="2">Dernière 24H</option>
                <option value="3">3 derniers jours</option>
                <option value="4">7 derniers jours</option>
            </select>
            <select id="contratFilter" class="my-2 appearance-none w-full py-2 px-4 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none">
                <option value="5">Type de contrat</option>
                <option value="6">CDI</option>
                <option value="7">CDD</option>
                <option value="8">Stage</option>
                <option value="9">Temps plein</option>
                <option value="10">Temps partiel</option>
                <option value="11">Intérim</option>
            </select>
        </div>
    </form>
</div>

<style>
    select {
        appearance: none;
    }
</style>


<style>
    select {
        appearance: none;
    }
</style>

<script>
    document.getElementById("submitButton").addEventListener("click", function () {
    const searchInput = document.getElementById("searchInput").value;
    const dateFilter = document.getElementById("dateFilter").value;
    const contratFilter = document.getElementById("contratFilter").value;
    const params = new URLSearchParams({
        inputSearch: searchInput,
        dateFilter: dateFilter,
        contratFilter: contratFilter
    });

    fetch(`vue_annonce.php?${params.toString()}`)
        .then(response => response.text())
        .then(data => {
            document.body.innerHTML = data; 
        })
        .catch(error => console.error("Erreur:", error));
});

</script>