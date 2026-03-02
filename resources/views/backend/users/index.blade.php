<x-backend.shell title="Users - SB Admin">
    <x-slot:head>
        <!-- Wordt geïnjecteerd in de <head> van de shell -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </x-slot:head>

    <x-backend.page-header class="page-header" title="Users">
    {{-- Actieknoppen toevoegen--}}
        <div class="d-flex align-items-center justify-content-center justify-content-between mb-4">
            <div class="small text-muted">
                Overzicht van alle gebruikers.
            </div>
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1">
                </i>
                Nieuwe User
            </a>
        </div>
{{--        Card met tabel er in--}}
       <x-backend.card header="Users lijst">
           <table class="table table-bordered table-striped mb-0" id="usersTable">
               <thead>
               <tr>
                   <th>ID</th>
                   <th>Naam</th>
                   <th>E-mail</th>
                   <th>Rol</th>
                   <th>Aangemaakt</th>
                   <th class="text-end">Acties</th>
               </tr>
               </thead>
               <tbody>
               @forelse($users as $user)
                   <tr>
                       <td>{{ $user->id }}</td>
                       <td>
                           {{ $user->name }}
                           @if(!$user->is_active)
                               <span class="badge bg-secondary ms-2">inactive</span>
                           @endif
                       </td>
                       <td>{{ $user->email }}</td>
                       <td>
                           {{ $user->role?->name ?? '—' }}
                       </td>
                       <td>{{ optional($user->created_at)->format('Y-m-d') }} - {{$user->created_at->diffForhumans()}}</td>

                       <td class="text-end">
                           <a href="#" class="btn btn-sm btn-outline-secondary">
                               Edit
                           </a>

                           <a href="#" class="btn btn-sm btn-outline-danger">
                               Delete
                           </a>
                       </td>
                   </tr>
               @empty
                   <tr>
                       <td colspan="6" class="text-center text-muted py-4">
                           Geen users gevonden.
                       </td>
                   </tr>
               @endforelse
               </tbody>


           </table>
           <div class="mt-3">
               {{ $users->links() }}
           </div>
       </x-backend.card>


    </x-backend.page-header>

</x-backend.shell>
