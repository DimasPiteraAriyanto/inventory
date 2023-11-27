@extends('dashboard.body.main')

@section('content')
    <!-- BEGIN: Header -->
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                            Edit Value
                        </h1>
                    </div>
                </div>

                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('values.index') }}">Values</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- END: Header -->

    <!-- BEGIN: Main Page Content -->
    <div class="container-xl px-2 mt-n10">
        <div id="valuesForm">
            <form id="valuesFormDynamic">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- BEGIN: Unit Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Value Master
                            </div>
                            <div class="card-body">
                                <!-- Form Group (name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="values_name">Nama Value <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" id="values_name" type="text" placeholder="" autocomplete="off" value="{{ $value->name }}">
                                </div>
                                <!-- Form Group (Description) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="values_description">Deskripsi</label>
                                    <input class="form-control form-control-solid" id="values_description" type="text" placeholder="" value="{{ $value->description }}">
                                </div>
                                <button class="btn btn-primary" type="button" onclick="updateMasterValue('{{ $value->id }}')">Update</button>

                            </div>
                              </div>
                        <!-- END: Unit Details -->
                    </div>
                </div>
            </form>
        </div>

        <div id="valueDetailsForm">
            <div class="row">
                <div class="col-xl-12">
                    <!-- BEGIN: Unit Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Values Details
                        </div>
                        <div class="card-body">
                            <div id="dynamicFormsContainer">
                                <span>Master Value</span>
                                @foreach($details as $index => $detail)
                                    <div class="mb-3">
                                        <input type="hidden" name="detail_ids[{{ $index }}]" value="{{ $detail->id }}" /> <!-- Add this line to include the id -->
                                        <input class="form-control form-control-solid my-2" id="details_name_{{ $index }}" type="text" name="names[{{ $index }}]" placeholder="" value="{{ $detail->name }}"/>
                                        <input class="form-control form-control-solid my-2" id="details_description_{{ $index }}" type="text" name="descriptions[{{ $index }}]" placeholder="" value="{{ $detail->description }}"/>
                                    </div>
                                @endforeach
                                <input type="hidden" id="master_value_id" name="master_value_id" value="{{ $value->id }}" />
                            </div>
                            <button class="btn btn-primary" type="button" onclick="addDynamicForm()">Add Form</button>
                            <button class="btn btn-danger" type="button" onclick="removeDynamicForm()">Remove Form</button>
                            <button class="btn btn-success" id="submit-button" type="submit" onclick="submitForm()">Submit All</button>
                        </div>
                    </div>
                    <!-- END: Unit Details -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Page Content -->



    <script>
        let formCount = {{ count($details) }}; // Assuming $details is an array of existing details

        function addDynamicForm() {
            formCount++;  // Increment the form count

            const dynamicFormsContainer = document.getElementById('dynamicFormsContainer');
            const newForm = document.createElement('div');
            newForm.classList.add('mb-3');

            newForm.innerHTML = `
        <input type="hidden" name="detail_ids[${formCount}]" value="" />
        <input class="form-control form-control-solid my-2" id="details_name_${formCount}" type="text" name="names[${formCount}]" placeholder="" value=""/>
        <input class="form-control form-control-solid my-2" id="details_description_${formCount}" type="text" name="descriptions[${formCount}]" placeholder="" value=""/>
    `;

            dynamicFormsContainer.appendChild(newForm);
        }


        function removeDynamicForm() {
            if (formCount > 1) {
                const dynamicFormsContainer = document.getElementById('dynamicFormsContainer');
                dynamicFormsContainer.removeChild(dynamicFormsContainer.lastChild);
                formCount--;
            }
        }

        function submitForm() {
            const data = {
                master_value_id: '{{ $value->id }}',
                details: []
            };
            const nameInput = document.getElementById(`details_name_2`);
            console.log('nameInput:', nameInput);


            for (let i = 0; i <= formCount; i++) {
                const detailIdInputs = document.getElementsByName(`detail_ids[${i}]`);
                const nameInput = document.getElementById(`details_name_${i}`);
                const descriptionInput = document.getElementById(`details_description_${i}`);

                // Check if at least one detailIdInput has a value
                const hasValidId = Array.from(detailIdInputs).some(input => input.value !== '');

                const detail = {
                    id: hasValidId ? detailIdInputs[0].value : null,
                    name: nameInput ? nameInput.value : '',
                    description: descriptionInput ? descriptionInput.value : ''
                };

                if (detail.id !== null || detail.name !== '' || detail.description !== '') {
                    // Only add if at least one field is not null or empty
                    data.details.push(detail);
                }
            }



            const updateRoute = '{{ route('values.updateDetail') }}';

            fetch(updateRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data updated:', data);
                    // Optionally, you can handle the response data here
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle errors here
                });
        }


        document.getElementById('submit-button').addEventListener('click', submitForm);


    function updateMasterValue(id) {
            const values_name = document.getElementById('values_name').value;
            const values_description = document.getElementById('values_description').value;

            fetch(`{{ url('/values/update') }}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: values_name,
                    description: values_description
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('MasterValue updated:', data);

                    // Optionally, update UI or display a success message
                })
                .catch(error => console.error('Error:', error));
        }

    </script>



@endsection
