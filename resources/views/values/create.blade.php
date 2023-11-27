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
                            Add Value
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
                                    <label class="small mb-1" for="values_name">Nama Value <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" id="values_name" type="text"
                                           placeholder="" autocomplete="off"/>
                                </div>
                                <!-- Form Group (Description) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="values_description">Deskripsi</label>
                                    <input class="form-control form-control-solid" id="values_description" type="text"
                                           placeholder=""/>
                                </div>
                                <!-- Submit button -->
                                <button class="btn btn-primary" type="button" onclick="showValueDetailsForm()">Next
                                </button>
                            </div>
                        </div>
                        <!-- END: Unit Details -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Main Page Content -->

    <!-- BEGIN: Main Page Content -->
    <div class="container-xl px-2 mt-n3">
        <div id="valueDetailsForm" style="display: none;">
            <form id="valueDetailsFormDynamic">
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
                                    <input class="form-control form-control-solid my-2" id="details_name_0" type="text"
                                           name="names[0]" placeholder="" value="${values_name}" readonly/>
                                    <input class="form-control form-control-solid my-2" id="details_description_0"
                                           type="text" name="descriptions[0]" placeholder=""
                                           value="${values_description}" readonly/>
                                    <input type="hidden" id="master_value_id" name="master_value_id" value=""/>
                                </div>
                                <button class="btn btn-primary" type="button" onclick="addDynamicForm()">Add Form
                                </button>
                                <button class="btn btn-danger" type="button" onclick="removeDynamicForm()">Remove Form
                                </button>
                                <button class="btn btn-success" type="submit">Submit All</button>
                            </div>
                        </div>
                        <!-- END: Unit Details -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Main Page Content -->

    <script>
        let formCount = 1; // Initial form count

        document.getElementById('valueDetailsFormDynamic').addEventListener('submit', function (event) {
            event.preventDefault();

            // Get the form data
            const formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            // Add dynamically added form fields to the form data
            for (let i = 1; i < formCount; i++) {
                const dynamicNameInput = document.getElementById(`details_name_${i}`);
                const dynamicDescriptionInput = document.getElementById(`details_description_${i}`);
                formData.append(`names[${i}]`, dynamicNameInput.value);
                formData.append(`descriptions[${i}]`, dynamicDescriptionInput.value);
            }

            fetch('{{ route('valueDetails.store') }}', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // console.log('Value Details stored:', data);

                    // Redirect to values.index after successful submission
                    window.location.href = '{{ route('values.index') }}';
                })
                .catch(error => console.error('Error:', error));
        });

        function addDynamicForm() {
            const dynamicFormsContainer = document.getElementById('dynamicFormsContainer');

            const inputName = document.createElement('input');
            inputName.className = 'form-control form-control-solid my-2';
            inputName.type = 'text';
            inputName.name = `names[${formCount}]`;
            inputName.placeholder = 'Enter name';
            inputName.id = `details_name_${formCount}`;

            const inputDescription = document.createElement('input');
            inputDescription.className = 'form-control form-control-solid my-2';
            inputDescription.type = 'text';
            inputDescription.name = `descriptions[${formCount}]`;
            inputDescription.placeholder = 'Enter description';
            inputDescription.id = `details_description_${formCount}`;

            dynamicFormsContainer.appendChild(inputName);
            dynamicFormsContainer.appendChild(inputDescription);

            formCount++;
        }

        function removeDynamicForm() {
            const dynamicFormsContainer = document.getElementById('dynamicFormsContainer');

            // Check if there are any fields to remove
            if (formCount > 1) {
                // Remove the last two added fields (name and description)
                dynamicFormsContainer.removeChild(dynamicFormsContainer.lastChild);
                dynamicFormsContainer.removeChild(dynamicFormsContainer.lastChild);

                formCount--;
            }
        }

        function showValueDetailsForm() {
            const values_name = document.getElementById('values_name').value;
            const values_description = document.getElementById('values_description').value;

            // Submit the values.store form via AJAX
            fetch('{{ route('values.store') }}', {
                method: 'POST',
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
                    // Set values in the second form
                    document.getElementById('details_name_0').value = values_name;
                    document.getElementById('details_description_0').value = values_description;
                    document.getElementById('master_value_id').value = data.value_id;

                    // Toggle visibility
                    document.getElementById('valuesForm').style.display = 'none';
                    document.getElementById('valueDetailsForm').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

@endsection
