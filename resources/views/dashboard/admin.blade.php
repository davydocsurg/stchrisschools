<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($parents) }}</h3>

                <p>Parents</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('parents.index') }}" class="small-box-footer">View All <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ count($students) }}</h3>

                <p>Students</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('students.index') }}" class="small-box-footer">View All <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ count($teachers) }}</h3>

                <p>Teachers</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('teachers.index') }}" class="small-box-footer">View All <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
