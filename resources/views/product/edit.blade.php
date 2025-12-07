<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Product</h4>
                        <a href="{{ url('/all-products') }}" class="btn btn-sm btn-outline-light">Back to List</a>
                    </div>
                    
                    <div class="card-body p-4">
                        <form id="editProductForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="productId" value="{{ $id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>

                            <div class="mb-3" id="currentImageContainer" style="display: none;">
                                <label class="form-label">Current Image:</label>
                                <div class="p-2 border rounded bg-light">
                                    <img id="currentImagePreview" src="" alt="Product Image" style="max-height: 150px; border-radius: 5px;">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Upload New Image (Optional)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="text-muted">Leave empty to keep the current image.</small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const productId = document.getElementById('productId').value;

        // 1. Fetch Existing Data when Page Loads
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                const response = await fetch(`/api/products/${productId}`);
                const result = await response.json();

                if (result.status) {
                    const product = result.data;
                    
                    // Fill the form inputs
                    document.getElementById('name').value = product.name;
                    document.getElementById('price').value = product.price;
                    document.getElementById('description').value = product.description;

                    // Show current image if it exists
                    if (product.image) {
                        document.getElementById('currentImageContainer').style.display = 'block';
                        document.getElementById('currentImagePreview').src = product.image;
                    }
                } else {
                    alert('Product not found!');
                    window.location.href = '/all-products';
                }
            } catch (error) {
                console.error('Error loading product:', error);
            }
        });

        // 2. Handle Update Submission
        document.getElementById('editProductForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            
            // TRICK: Laravel cannot handle file uploads with "PUT" method directly.
            // We must use "POST" and add a hidden field "_method" set to "PUT".
            formData.append('_method', 'PUT'); 

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerText = 'Updating...';

            try {
                // Send as POST (spoofed as PUT)
                const response = await fetch(`/api/products/${productId}`, {
                    method: 'POST', 
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Updated Successfully!');
                    window.location.href = '/all-products';
                } else {
                    alert('Error: ' + (result.message || 'Update failed'));
                }
            } catch (error) {
                console.error('Error updating:', error);
                alert('Something went wrong!');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Update Product';
            }
        });
    </script>

  </body>
</html>