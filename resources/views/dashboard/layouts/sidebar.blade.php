<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin-asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> لوحة تحكم النظام</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-asset/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        @endauth
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-smile"></i>
                        <p>
                          الرئيسية
                        </p>
                    </a>
                </li>
                @canany(['Read-VolunteerCategory', 'Create-VolunteerCategory', 'Delete-VolunteerCategory'])
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-layer-group nav-icon"></i>
                        <p>
                            فئات العمل التطوعي
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can(['Read-VolunteerCategory'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عرض الفئات</p>
                            </a>
                        </li>
                        @endcan
                        @can(['Create-VolunteerCategory'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.categories.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>انشاء فئة</p>
                            </a>
                        </li>
                        @endcan
                        @can(['Delete-VolunteerCategory'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.categories.trash')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سلة المحذوفات</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['Read-Posts', 'Create-Post', 'Delete-Post'])
                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>الاعمال التطوعية
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @can(['Read-Posts'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.posts.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عرض الاعمال</p>
                            </a>
                        </li>
                        @endcan
                        @can(['Create-Post'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.posts.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>انشاء عمل</p>
                            </a>
                        </li>
                        @endcan
                        @can(['Delete-Post'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.posts.trash')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سلة المحذوفات</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>

                @endcanany





                {{-- <li class="nav-header">Human Resoueces</li> --}}
                @canany(['Create-Admin', 'Read-Admins'])
                <li class="nav-header">الموارد البشرية </li>
                @canany(['Create-Admin', 'Read-Admins'])
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>
                      الأدمن
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                      @can('Create-Admin')
                      <li class="nav-item">
                          <a href="{{route('dashboard.admin.create')}}" class="nav-link">
                            <i class="fas fa-plus-suquer"></i>
                            <i class="far fa-plus-square nav-icon"></i>
                            <p>انشاء</p>
                          </a>
                        </li>
                        @endcan
                        @can('Read-Admins')
                      <li class="nav-item">
                          <a href="{{route('dashboard.admin.index')}}" class="nav-link">
                              <i class="fas fa-list nav-icon"></i>
                            <p>عرض </p>
                          </a>
                        </li>
                        @endcan
                  </ul>
                </li>
                @endcanany
                @canany(['Read-Institutions','Create-Institution'])

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                            <p>
                        المؤسسات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can(['Read-Institutions'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.institution.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عرض المؤسسات</p>
                            </a>
                        </li>
                        @endcan
                        @can(['Create-Institution'])
                        <li class="nav-item">
                            <a href="{{route('dashboard.institution.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>انشاء مؤسسة</p>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany



                @endcanany



                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user nav-icon"></i>
                      <p>
                        المستخدمين
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('dashboard.user.create')}}" class="nav-link">
                              <i class="fas fa-plus-suquer"></i>
                              <i class="far fa-plus-square nav-icon"></i>
                              <p>انشاء</p>
                            </a>
                          </li>


                        <li class="nav-item">
                            <a href="{{route('dashboard.user.index')}}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                              <p>عرض</p>
                            </a>
                          </li>
                    </ul>
                  </li>

                @canany(['Read-Roles', 'Create-Role', 'Create-Permission','Read-Permissions'])
                <li class="nav-header">الأدوار والصلاحيات </li>
                @canany(['Read-Roles', 'Create-Role'])
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-user-tag nav-icon"></i>
                    <p>
                      الأدوار
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                      @can('Create-Role')
                      <li class="nav-item">
                          <a href="{{route('dashboard.roles.create')}}" class="nav-link">
                            <i class="far fa-plus-square nav-icon"></i>
                            <p>انشاء</p>
                          </a>
                        </li>
                        @endcan
                        @can('Read-Roles')
                      <li class="nav-item">
                          <a href="{{route('dashboard.roles.index')}}" class="nav-link">
                              <i class="fas fa-list nav-icon"></i>
                            <p>عرض</p>
                          </a>
                        </li>
                        @endcan
                  </ul>
                </li>
                @endcanany
                @canany(['Create-Permission', 'Read-Permissions'])
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-key nav-icon"></i>
                    <p>
                      الصلاحيات
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                      @can('Create-Permission')
                      <li class="nav-item">
                          <a href="{{route('dashboard.permissions.create')}}" class="nav-link">
                            {{-- <i class="fas fa-plus-suquer"></i> --}}
                            <i class="far fa-plus-square nav-icon"></i>
                            <p>انشاء</p>
                          </a>
                        </li>
                        @endcan
                        @can('Read-Permissions')
                      <li class="nav-item">
                          <a href="{{route('dashboard.permissions.index')}}" class="nav-link">
                              <i class="fas fa-list nav-icon"></i>
                            <p>عرض</p>
                          </a>
                        </li>
                        @endcan
                  </ul>
                </li>
                @endcanany
                @endcanany

                <li class="nav-item">
                    <a href="{{route('dashboard.change-password')}}" class="nav-link">
                      <i class="nav-icon fas fa-lock"></i>
                      <p>تغيير كلمة المرور</p>
                    </a>
                  </li>


          <li class="nav-header">الاعدادات</li>

          <li class="nav-item">
            <a href="{{route('dashboard.logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>تسجيل خروج</p>
            </a>
          </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
