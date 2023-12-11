<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">	
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">				
					<li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''}}" href="{{route('backoffice.index')}}">
							<i data-feather="monitor" class="{{in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''}}"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.appointments.index'])?'text-primary':''}}" href="{{ route('backoffice.appointments.index') }}">
							<i data-feather="calendar" class="{{in_array(request()->route()->getName(),['backoffice.appointments.index'])?'text-primary':''}}"></i>
							<span>Appointments</span>
						</a>
					</li>		
					@if( in_array(auth()->user()->type, ['super_user', 'admin']) )	
					<li class="treeview {{Request::is('backoffice/vets*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/vets*')?'text-primary':''}}">
							<i data-feather="briefcase" class="{{Request::is('backoffice/vets*')?'text-primary':''}}"></i>
							<span>Veterinarians</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/vets*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.vets.index'])?'text-primary':''}}" href="{{route('backoffice.vets.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.vets.create'])?'text-primary':''}}" href="{{route('backoffice.vets.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>		
					<li class="treeview {{Request::is('backoffice/patients*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/patients*')?'text-primary':''}}">
							<i data-feather="users" class="{{Request::is('backoffice/patients*')?'text-primary':''}}"></i>
							<span>Patients</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/patients*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.patients.index'])?'text-primary':''}}" href="{{route('backoffice.patients.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.patients.create'])?'text-primary':''}}" href="{{route('backoffice.patients.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>		
					<li class="treeview {{Request::is('backoffice/services*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/services*')?'text-primary':''}}">
							<i data-feather="heart" class="{{Request::is('backoffice/services*')?'text-primary':''}}"></i>
							<span>Services</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/services*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.services.index'])?'text-primary':''}}" href="{{route('backoffice.services.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.services.create'])?'text-primary':''}}" href="{{route('backoffice.services.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>
					<li class="treeview {{Request::is('backoffice/inventory*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/inventory*')?'text-primary':''}}">
							<i data-feather="package" class="{{Request::is('backoffice/inventory*')?'text-primary':''}}"></i>	
							<span>Inventory</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/inventory*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.inventory.index'])?'text-primary':''}}" href="{{route('backoffice.inventory.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.inventory.create'])?'text-primary':''}}" href="{{route('backoffice.inventory.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>
					</li>
					<li class="treeview {{Request::is('backoffice/records*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/records*')?'text-primary':''}}">
							<i data-feather="activity" class="{{Request::is('backoffice/records*')?'text-primary':''}}"></i>
							<span>Records</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/records*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.records.index'])?'text-primary':''}}" href="{{route('backoffice.records.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.records.create'])?'text-primary':''}}" href="{{route('backoffice.records.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>
					</li> 
					@else
					@if(auth()->user()->type == 'vet')
					<li class="treeview {{Request::is('backoffice/records*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/records*')?'text-primary':''}}">
							<i data-feather="activity" class="{{Request::is('backoffice/records*')?'text-primary':''}}"></i>
							<span>Records</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/records*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.records.index'])?'text-primary':''}}" href="{{route('backoffice.records.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.records.create'])?'text-primary':''}}" href="{{route('backoffice.records.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>
					</li> 
					@endif
					<li>
						@if(auth()->user()->type == 'patient')
						<a class="{{in_array(request()->route()->getName(),['backoffice.patients.view'])?'text-primary':''}}" href="{{ route('backoffice.patients.view', auth()->user()->patient->id) }}">
							<i data-feather="user" class="{{in_array(request()->route()->getName(),['backoffice.patients.view'])?'text-primary':''}}"></i>
							<span>My Info</span>
						</a>
						@elseif(auth()->user()->type == 'vet')
						<a class="{{in_array(request()->route()->getName(),['backoffice.vets.view'])?'text-primary':''}}" href="{{ route('backoffice.vets.view', auth()->user()->vet->id) }}">
							<i data-feather="user" class="{{in_array(request()->route()->getName(),['backoffice.vets.view'])?'text-primary':''}}"></i>
							<span>My Info</span>
						</a>
						@endif
					</li>	
					@endif	     
				</ul>
				
				<div class="sidebar-widgets">
					<div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
						<div class="text-center">
							<img src="{{asset('vet-clinic/images/vet-clinic.png')}}" class="sideimg p-5" alt="">
							<h4 class="title-bx text-primary">Request for an Appointment</h4>
							<a href="{{ route('backoffice.appointments.index') }}" class="py-10 fs-14 mb-0 text-primary">
								Best Vet Care here <i class="mdi mdi-arrow-right"></i>
							</a>
						</div>
					</div>
					<div class="copyright text-center m-25">
						<p><strong class="d-block">{{config('app.name')}}</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</aside>