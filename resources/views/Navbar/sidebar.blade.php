  <aside class="sidebar overflow-hidden">
      <a href="{{ url('/') }}" class="sidebar-logo">
          <div class="d-flex justify-content-start align-items-center">
              {{-- <img src="{{ asset('template/assets/img/global/logo.svg') }}" alt="">
               --}}
              {{-- <span>PowerHuman</span> --}}
              <img src="{{ asset('app/assets/images/logo-sky.png') }}" alt="" width="150px">
          </div>

          <button id="toggle-navbar" onclick="toggleNavbar()">
              <img src="{{ asset('template/assets/img/global/navbar-times.svg') }}" alt="">
          </button>
      </a>
      <h5 class="sidebar-title">Daily Use</h5>
      @if (Auth::check() && Auth::user()->role_id == 1)
          {{-- <a href="{{ route('admin.dashboard.index') }}" --}}
          <a href="{{ route('admin.dashboard') }}"
              class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <!-- <img src="./assets/img/global/grid.svg" alt=""> -->

              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
              </svg>

              <span>Dashboard</span>
          </a>

          <a href="{{ route('admin.exam.index') }}"
              class="sidebar-item {{ request()->is('admin/exam*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <!-- <img src="./assets/img/global/grid.svg" alt=""> -->

              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
              </svg>

              <span>Exam</span>
          </a>

          {{-- <a href="{{ route('admin.students.index') }}" --}}
          <a href="{{ route('admin.student') }}"
              class="sidebar-item {{ request()->is('admin/student*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                      d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                      d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                      d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

              <span>Students</span>
          </a>

          {{-- <a href="{{ route('admin.interviews.index') }}" --}}
          <a href="{{ route('interview.index') }}"
              class="sidebar-item {{ request()->is('interview*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                      d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

              <span>Interview</span>
          </a>

          <a href="{{ route('transactiontype.index') }}"
              class="sidebar-item {{ request()->is('transactiontype*') ? 'active' : '' }}"
              onclick="toggleActive(this)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                      d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

              <span>Jenis Transaksi</span>
          </a>
      @endif

      @if (Auth::check() && Auth::user()->role_id == 3)
          {{-- <a href="{{ route('student.dashboard.index') }}" --}}
          <a href="{{ route('student.dashboard') }}"
              class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <!-- <img src="./assets/img/global/grid.svg" alt=""> -->

              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
              </svg>

              <span>Dashboard</span>
          </a>

          {{-- <a href="{{ route('student.students.show', ['student' => Auth::user()->student->id]) }}" class="sidebar-item {{ request()->is('student.students*') ? 'active' : '' }}" --}}
          <a href="{{ route('student.student.show', ['unique_code' => Auth::user()->student->unique_code]) }}"
              class="sidebar-item {{ request()->is('students*') ? 'active' : '' }}" onclick="toggleActive(this)">
              <!-- <img src="./assets/img/global/gift.svg" alt=""> -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-person-vcard" viewBox="0 0 16 16">
                  <path
                      d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                  <path
                      d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
              </svg>

              <span>Student Detail</span>
          </a>
      @endif



      <a href="{{ route('admin.profile.edit') }}"
          class="sidebar-item {{ request()->is('admin.profile*') ? 'active' : '' }}" onclick="toggleActive(this)">
          <!-- <img src="./assets/img/global/settings.svg" alt=""> -->

          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                  stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                  d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15V15Z"
                  stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <span>Account Setting</span>
      </a>

      {{-- <a href="{{ route('profile.edit') }}" class="sidebar-item {{ request()->is('profile*') ? 'active' : '' }}"
          onclick="toggleActive(this)">
          <!-- <img src="./assets/img/global/settings.svg" alt=""> -->

          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                  stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                  d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15V15Z"
                  stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <span>Account Setting</span>
      </a> --}}

      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="sidebar-item"
              onclick="event.preventDefault();
                  this.closest('form').submit(); toogleActive(this)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d=" M16 17L21 12L16 7" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path d="M21 12H9" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  <path
                      d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                      stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

              <span>Logout</span></a>
      </form>

  </aside>
