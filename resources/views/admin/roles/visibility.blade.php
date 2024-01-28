<style>
    .scroll::-webkit-scrollbar {
        display: none;
    }

    .scroll::-webkit-scrollbar-track {

        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0) !important;
        border-radius: 10px !important;
        margin-bottom: 10px !important;
    }

    .scroll::-webkit-scrollbar-thumb {
        border-radius: 10px !important;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.4) !important;
    }

    .t_body tr td {
        font-size: 15px;
        font-weight: 500
    }

    .t_head tr th {
        background-color: #e6eff8 !important
    }
</style>

<form action="{{ route('roles.visiblitySave', app()->getLocale()) }}" method="post" style="">
    @csrf
    <input type="hidden" name="role_id" value="{{ $role->id }}" />
    {{-- <div class=" px-3 py-2 sm-px-2 d-flex">
        <h3 class="fw-bold fs-4">{{ trans('app.Visible') }}</h3>
    </div> --}}
    <div class="  mb-0 px-3">
        <div class="d-flex flex-column">
            <div class="o scroll">
                <div class="mb-0 align-middle d-inline-block w-100">
                    <div class="shadow-sm ">
                        <table class="table  table-striped">
                            <thead class="t_head" style=" position: sticky; top: 0px !important; ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-uppercase  fw-bold">
                                        #
                                    </th>
                                    <th scope=" col" class="px-6 py-3 text-start text-uppercase  fw-bold">
                                        {{ trans('app.Tab Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start text-uppercase  fw-bold">
                                        {{ trans('app.Add') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start text-uppercase  fw-bold">
                                        {{ trans('app.Edit') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start text-uppercase  fw-bold">
                                        {{ trans('app.Delete') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="t_body" style="background-color: #f4f4f5">
                                @php
                                    $costing = ['garment', 'sadi', 'lengha', 'lace', 'suit'];
                                    $material = ['garment_material', 'sadi_matireal', 'lengha_matireal', 'lace_matireal', 'suit_matireal'];
                                @endphp
                                @foreach ($tabs as $tab)
                                    @php
                                        $visiblity = $tab
                                            ->visibility()
                                            ->where('role_id', $role->id)
                                            ->first();
                                    @endphp
                                    @if (isset($visiblity) && $visiblity->visible == 1)
                                        <tr>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="mainTab"
                                                    data-target="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][visible]"
                                                    @if ($visiblity->visible == 1) {{ 'checked' }} @endif>
                                            </td>
                                            <td class="px-6 py-3 ">
                                                {{ trans('app.' . $tab->name) }}
                                                @if (in_array($tab->url, $costing))
                                                    {{ ' Costing ' }};
                                                @endif
                                                @if (in_array($tab->url, $material))
                                                    {{ ' Material ' }};
                                                @endif
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][add_row]"
                                                    @if ($visiblity->add_row == 1) {{ 'checked' }} @endif>
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][update_row]"
                                                    @if ($visiblity->update_row == 1) {{ 'checked' }} @endif>
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][delete_row]"
                                                    @if ($visiblity->delete_row == 1) {{ 'checked' }} @endif>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="mainTab"
                                                    data-target="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][visible]">
                                            </td>
                                            <td class="px-6 py-3">
                                                {{ trans('app.' . $tab->name) }}
                                                @if (in_array($tab->url, $costing))
                                                    {{ ' Costing ' }}
                                                @endif
                                                @if (in_array($tab->url, $material))
                                                    {{ ' Material ' }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][add_row]" disabled>
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][update_row]" disabled>
                                            </td>
                                            <td class="px-6 py-3">
                                                <input type="checkbox" class="subTab{{ $tab->id }}"
                                                    name="tab[{{ $tab->id }}][delete_row]" disabled>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer p-1 d-flex justify-content-start "
        style=" position: sticky; bottom: 0 !important; background-color: white ">
        @if ($status == 1)
            <button type="submit" class="mt-3 btn btn-primary">
                {{ trans('app.Save') }}
            </button>
        @endif
        <button type="button" data-dismiss="modal" onclick="hideDiv(this)" class="mt-3 btn btn-secondary">
            {{ trans('app.Cancel') }}
        </button>
    </div>
</form>
<script src="{{ asset('public/admin/formsubmit.js') }}"></script>
<script>
    $(".mainTab").on('change', function() {
        var subClass = $(this).data('target');
        if ($(this).prop("checked") == true) {
            $('.' + subClass).attr('disabled', false);
        } else {
            $('.' + subClass).attr('disabled', true);
        }
        $('.' + subClass).prop('checked', $(this).prop("checked"));
    });
</script>
