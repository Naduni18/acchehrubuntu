<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Todays birthdays</h5>
                                    @foreach($birthday_array as $key)
                                    <span class="h4 text-muted mb-0">{{$key->name}}</span>
                                    @endforeach
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                    <i class="fas fa-birthday-cake"></i>
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Todays anniversaries</h5>
                                    @foreach($anniversary_array as $key)
                                    <span class="h4 text-muted mb-0">{{$key->name}}</span>
                                    @endforeach
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-gift"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Leaves-this month</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$no_of_leaves}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Leaves-this year</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$no_of_leaves_y}}&#32;&#47;&#32;21</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-purple text-white rounded-circle shadow">
                                    <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
               
                <div class="col">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Absences-last month</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$no_of_absent_days}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div> 
                </div>
                
                
        </div>
    </div>
</div>