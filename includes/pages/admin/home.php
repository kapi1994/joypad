<div class="container">
    <div class="row mt-5">
        <div class="d-none my-2" id="home-message"></div>
        <div class="col-lg-9">
            <div class="row mb-2">
                <div class="table-responsive-sm table-responsive-md">
                    <table class="table text-center align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Game name</th>
                                <th scope="col">Platform name</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="top-games"></tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 mb-2 mb-lg-0">
                    <div class="card">
                        <div class="fs-3">Number of products</div>
                        <div class="fs-4" id="numberOfProducts"></div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2 mb-lg-0">
                    <div class="card">
                        <div class="fs-3">Number of users</div>
                        <div class="fs-4" id="numberOfUsers"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="fs-3">Number of orders</div>
                        <div class="fs-4" id="numberOfOrders"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-2 mt-lg-0">
            <div class="card text-center">
                <div class="fs-2 mb-2 ">Vote stats</div>
                <canvas id="chart-stats"></canvas>
                <div class="px-2">
                    <table class="table align-middle" id="table-data">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Percent</th>
                            </tr>
                        </thead>
                        <tbody id="stats-data"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>