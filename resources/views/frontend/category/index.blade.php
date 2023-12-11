@extends('layouts.app')
@section('title')
All Categories
@endsection
@section('content')
<div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills  me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @foreach ($categories as $kia => $item)
        <a class="nav-link {{$kia==0 ? 'active':''}}" id="v-pills-{{$item->name}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$item->name}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <img src="{{asset($item->image)}}" alt="" class=""  style="height: 50px; width:50px; object-fit:contain">
            <br>
            {{$item->name}}
        </a>
        @endforeach
    </div>
    <div class="tab-content" id="v-pills-tabContent">
        @foreach ($categories as $kia => $item)

      <div class="tab-pane fade {{$kia==0 ? 'show active':''}} " id="v-pills-{{$item->name}}" role="tabpanel" aria-labelledby="v-pills-{{$item->name}}-tab" tabindex="0">
        @if (!blank($item->children))
            <div class="row ">
                @foreach ($item->children as $ch)

                <div class="col-4">
                        <a class="text-center" href="{{route('category.show', ['id'=>$ch->slug])}}">
                            <img src="{{asset($ch->image)}}" alt="" class=" my-1" style="height: 50px; width:50px; object-fit:contain">
                            <br>
                            {{$ch->name}}
                        </a>
                      </div>



                @endforeach

            </div>
        @endif
       </div>
        @endforeach
      {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div> --}}
    </div>

  </div>
  <div class=" my-5 text-center">
    {!! $categories->appends(Request::all())->links() !!}
</div>
    <!-- Blog Section End -->
@endsection
