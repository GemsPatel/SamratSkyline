<?php
$adminMenuArr = getAdminSideMenu();
$menuArr = getAdminSideMenuPerimission();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/admin')}}" class="brand-link">
    <img src="{{url( 'storage/app/'.$headerInfo->favicon )}}" alt="{{pgTitle( $headerInfo->name )}}" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{pgTitle( $headerInfo->name )}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($adminMenuArr as $menu)
          @if( in_array( $menu->id, $menuArr ) )
            <li class="nav-item">
              <?php
              $href = "";
              if( !$menu->childArr->isEmpty() || $menu->class_name == "/"){
                $href = "#";
              } else {
                $href = route($menu->class_name);
              }
              ?>
                <a href="{{$href}}" class="nav-link">
                  <i class="nav-icon {{$menu->icon}}"></i>
                  <p>{{$menu->name ?? 'P'}}</p>
                  @if( !$menu->childArr->isEmpty() )
                    <i class="right fas fa-angle-left"></i>
                  @endif
                </a>
                @if( !$menu->childArr->isEmpty() )
                  <ul class="nav nav-treeview ml-3 treeview-{{$menu->id.'-'.$menu->slug}}">
                    @foreach ($menu->childArr as $cmenu)
                      <?php
                      $linkArr = explode( ".", $cmenu->class_name );
                      $href = "";
                      if( $cmenu->class_name == "/"){
                        $href = "#";
                      } else {
                        $href = route($cmenu->class_name);
                      }
                      ?>
                      @if( in_array( $cmenu->id, $menuArr ) )
                        <li class="nav-item">
                          <a href="{{$href}}" class="nav-link {{ ( request()->is( 'admin/'.end($linkArr) ) || request()->is( 'admin/'.end($linkArr).'/*' ) ) ? 'active' : '' }}">
                            <i class="nav-icon {{$cmenu->icon}}"></i>
                            <p>{{$cmenu->name}}</p>
                          </a>
                        </li>
                        @if( "admin.type" == $cmenu->class_name )
                          <?php
                          $types = getTypes();
                          $typeSlug = [ 2 => 'audiobook', 1 => 'audiodrama', 3 => 'podcast' ];
                          $typeIcon = [ 2 => 'fa fa-book', 1 => 'fa fa-file-audio', 3 => 'fa fa-podcast' ];
                          ?>
                          @foreach ( $types as $ar )
                            <?php
                            $href = url( 'admin/'.$typeSlug[$ar['type']].'/'.$ar['id'].'/'.$ar['slug']);
                            ?>
                            <li class="nav-item">
                              <a href="{{$href}}" class="nav-link {{ ( request()->is( 'admin/'.$typeSlug[$ar['type']].'/'.$ar['id'].'/'.$ar['slug'] ) || request()->is( 'admin/'.$typeSlug[$ar['type']].'/'.$ar['id'].'/'.$ar['slug'].'/*' ) ) ? 'active' : '' }}">
                                <i class="nav-icon {{$typeIcon[$ar['type']]}}"></i>
                                <p>{{$ar->title}}</p>
                              </a>
                            </li>
                            @if( request()->is( 'admin/'.$typeSlug[$ar['type']].'/'.$ar['id'].'/'.$ar['slug'] ) || request()->is( 'admin/'.$typeSlug[$ar['type']].'/'.$ar['id'].'/'.$ar['slug'].'/*' ) )
                              <script>
                                $(".treeview-{{$menu->id.'-'.$menu->slug}}").show();
                              </script>
                            @endif
                          @endforeach
                        @endif
                        @if( request()->is( 'admin/'.end($linkArr) ) || request()->is( 'admin/'.end($linkArr).'/*' ) )
                          <script>
                            $(".treeview-{{$menu->id.'-'.$menu->slug}}").show();
                          </script>
                        @endif
                      @endif
                    @endforeach
                </ul>
              @endif
            </li>
          @endif
        @endforeach
      </ul>
    </nav>
  </div>
</aside>
