<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($lessons) }}</h3>

                <p>Lessons</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('lessons.index') }}" class="small-box-footer">View All <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
