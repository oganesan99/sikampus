<x-layouts.app>
  <x-slot:head>
    <title>Title</title>
    <meta
      content="Description"
      name="description"
    >
    <meta
      content="Keywords"
      name="keywords"
    >
  </x-slot:head>

  <x-slot:body>
    <x-layouts.dashboard-shell>
      <x-slot:head>
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                Combo layout
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="d-print-none col-auto ms-auto">
              <div class="btn-list">
                <span class="d-none d-sm-inline">
                  <a
                    class="btn"
                    href="#"
                  >
                    New view
                  </a>
                </span>
                <a
                  class="btn btn-primary d-none d-sm-inline-block"
                  data-bs-target="#modal-report"
                  data-bs-toggle="modal"
                  href="#"
                >
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg
                    class="icon"
                    fill="none"
                    height="24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    width="24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M0 0h24v24H0z"
                      fill="none"
                      stroke="none"
                    />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                  Create new report
                </a>
                <a
                  aria-label="Create new report"
                  class="btn btn-primary d-sm-none btn-icon"
                  data-bs-target="#modal-report"
                  data-bs-toggle="modal"
                  href="#"
                >
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg
                    class="icon"
                    fill="none"
                    height="24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    width="24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M0 0h24v24H0z"
                      fill="none"
                      stroke="none"
                    />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </x-slot:head>

      <div class="container-xl">
        <div class="row row-deck row-cards">
        </div>
      </div>
    </x-layouts.dashboard-shell>
  </x-slot:body>
</x-layouts.app>
