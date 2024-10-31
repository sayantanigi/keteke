<main class="main-one" id="main-one">
    <div class="container">
        <div class="bootstrap snippets bootdey">
            <div class="row">
                <div class="profile-nav col-md-3">
                    <?php
                    $this->load->front_view('user_sidebar', $this->data);
                    ?>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="panel-body bio-graph-info">
                            <h1>Search History</h1>
                            <div class="row">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Business</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>