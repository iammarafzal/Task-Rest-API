<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Product</h4>
                        <a href="{{ url('/all-products') }}" class="btn btn-sm btn-outline-light">Back to List</a>
                    </div>
                    
                    <div class="card-body p-4">
                        <form id="createProductForm" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Laptop" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product details..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <script>
        document.getElementById('createProductForm').addEventListener('submit', async function(e) {
            e.preventDefault(); // Stop the page from reloading/submitting normally

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            
            // Disable button and show loading text
            submitBtn.disabled = true;
            submitBtn.innerText = 'Saving...';

            try {
                // Send data to your API
                const response = await fetch('/api/products', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Success! ' + result.message);
                    // Redirect back to the list page
                    window.location.href = '/all-products'; 
                } else {
                    // Handle Validation Errors
                    alert('Error: ' + JSON.stringify(result.message || result));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Something went wrong!');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerText = 'Save Product';
            }
        });
    </script>

  </body>
</html>