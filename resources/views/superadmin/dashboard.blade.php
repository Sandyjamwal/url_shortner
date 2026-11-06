<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container m-5">
        <div class="heading d-flex justify-content-between align-items-center">
         <h3 class="mb-0 fw-bold">Clients</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invite_clients">Invite</button>
        </div>
        <div class="list mt-2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    {{-- invite clients modal --}}
    <!-- Modal -->
    <div class="modal fade" id="invite_clients" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invite_clients" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="invite_clients">Invite New Clients</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form>
                 <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Invite</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
