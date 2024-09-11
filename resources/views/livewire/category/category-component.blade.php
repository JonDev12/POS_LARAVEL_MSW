<div>

    <x-card cardTitle="Listado categorias"  cardFooter="">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary">Crear categoria</a>
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre categoria</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>
            <tr>
                <td>....</td>
                <td>....</td>
                <td>
                    <a href="#" class="btn btn-success btn-xs" title="Ver item">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-primary btn-xs" title="Editar item">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-xs" title="Elminar item">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        </x-table>
    </x-card>

</div>
