@props(['complaint'])
<div id="card"
      class="mx-7  my-4 w-60 h-60 cursor-pointer overflow-hidden rounded-xl bg-white shadow-md duration-200 hover:scale-105 hover:shadow-xl">
      <div class="p-5 border h-full flex flex-col justify-around">
            <p class="text-center">
                  {{$complaint->purpose_of_visit}}
            </p>
            <button onclick="document.location.href='/dashboard/visitors/{{$complaint->purpose_of_visit}}'" class="bg-sasra_color hover:bg-sasra_hover w-full rounded-md py-2 text-indigo-100 duration-75 hover:text-slate-900 hover:shadow-md">Select</button>
      </div>
</div>