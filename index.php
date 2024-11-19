<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tính Phí Bảo Hiểm</title>
  <link rel="stylesheet" href="public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet" />
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet" />
  <!-- MDB -->
  <link
    href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@8.1.0/css/mdb.min.css"
    rel="stylesheet" />
</head>

<body>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="public/images/tinhphi_logo.png" alt="Logo" width="200" class="d-inline-block align-text-top">
      </a>
    </div>
  </nav>
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-12">
        <div class="text-danger p-3 fs-2 fw-bold">Tính Phí Bảo Hiểm Dai-Ichi</div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 d-flex justify-content-end p-2">
        <button type="button" class="btn btn-success">Xem ngành nghề</button>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12 p-0 pt-3">
          <div class="accordion w-100" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding: 5px;">
                  <span class="accordion-number">1</span> NGƯỜI ĐƯỢC BH CHÍNH
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form style="width: 22rem;">
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4 border-bottom">
                      <input type="text" id="form5Example1" class="form-control" />
                      <label class="form-label" for="form5Example1">Name</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4 border-bottom">
                      <input type="email" id="form5Example2" class="form-control" />
                      <label class="form-label" for="form5Example2">Email address</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                      <input
                        class="form-check-input me-2"
                        type="checkbox"
                        value=""
                        id="form5Example3"
                        checked />
                      <label class="form-check-label" for="form5Example3">
                        I have read and agree to the terms
                      </label>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="button" class="btn btn-primary btn-block mb-4">Subscribe</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="padding: 5px;">
                  <span class="accordion-number">2</span> NGƯỜI ĐƯỢC BH BỔ SUNG 1
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="padding: 5px;">
                  <span class="accordion-number">3</span> NGƯỜI ĐƯỢC BH BỔ SUNG 2
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="padding: 5px;">
                  <span class="accordion-number">3</span> NGƯỜI ĐƯỢC BH BỔ SUNG 3
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="w-100 mb-2" style="overflow-x: hidden;">
    <div class="row">
      <div class="col-sm-12 d-flex justify-content-center mt-3 text-bg-light">
        <div class="text-success pt-2 pb-2 fs-5 fw-bold text-decoration-underline">Tổng cộng phí</div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">QUÝ (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">Nửa năm (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">Năm (VNĐ): 0</div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>