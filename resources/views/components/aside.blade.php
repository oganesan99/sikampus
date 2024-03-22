<aside
  class="navbar navbar-vertical navbar-expand-lg"
  data-bs-theme="dark"
>
  <div class="container-fluid">
    <button
      aria-controls="sidebar-menu"
      aria-expanded="false"
      aria-label="Toggle navigation"
      class="navbar-toggler"
      data-bs-target="#sidebar-menu"
      data-bs-toggle="collapse"
      type="button"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href="/">
        <img
          alt="Tabler"
          class="navbar-brand-image"
          height="32"
          src="/static/images/icons/logo.png"
          width="110"
        >
      </a>
    </h1>
    <div class="navbar-nav d-lg-none flex-row">
      <div class="nav-item dropdown">
        <a
          aria-label="Open user menu"
          class="nav-link d-flex lh-1 text-reset p-0"
          data-bs-toggle="dropdown"
          href="#"
        >
          <span
            class="avatar avatar-sm"
            style="background-image: url(/static/images/icons/logo.png)"
          ></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a
            class="dropdown-item"
            href="#"
          >Status</a>
          <a
            class="dropdown-item"
            href="./profile.html"
          >Profile</a>
          <a
            class="dropdown-item"
            href="#"
          >Feedback</a>
          <div class="dropdown-divider"></div>
          <a
            class="dropdown-item"
            href="./settings.html"
          >Settings</a>
          <a
            class="dropdown-item"
            href="./sign-in.html"
          >Logout</a>
        </div>
      </div>
    </div>
    <div
      class="navbar-collapse collapse"
      id="sidebar-menu"
    >
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item dropdown">
          <a
            aria-expanded="false"
            class="nav-link dropdown-toggle"
            data-bs-auto-close="false"
            data-bs-toggle="dropdown"
            href="#navbar-help"
            role="button"
          >
            <span
              class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
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
                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                <path d="M15 15l3.35 3.35" />
                <path d="M9 15l-3.35 3.35" />
                <path d="M5.65 5.65l3.35 3.35" />
                <path d="M18.35 5.65l-3.35 3.35" />
              </svg>
            </span>
            <span class="nav-link-title">
              Help
            </span>
          </a>
          <div class="dropdown-menu">
            <a
              class="dropdown-item"
              href="https://tabler.io/docs"
              rel="noopener"
              target="_blank"
            >
              Documentation
            </a>
            <a
              class="dropdown-item"
              href="./changelog.html"
            >
              Changelog
            </a>
            <a
              class="dropdown-item"
              href="https://github.com/tabler/tabler"
              rel="noopener"
              target="_blank"
            >
              Source code
            </a>
            <a
              class="dropdown-item text-pink"
              href="https://github.com/sponsors/codecalm"
              rel="noopener"
              target="_blank"
            >
              <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
              <svg
                class="icon icon-inline me-1"
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
                <path
                  d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"
                />
              </svg>
              Sponsor project!
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</aside>
