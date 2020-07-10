<div>


    <form action="{{$action}}" method="post" class="submit_data">
        @csrf()
        <div class="panel-body custom-panel-body">

            <x-select col="col-md-5" name="department" :model="\App\Models\Department::all()" />

            <x-select col="col-md-5" name="project" :model="\App\Models\Project::all()" />
            <x-input col="col-md-2" name="" type="button" class="btn btn-info get_data_by_form_submit"
                value="{{$btnText}}" />



        </div>
    </form>





</div>