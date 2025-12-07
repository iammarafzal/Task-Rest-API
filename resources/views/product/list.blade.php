<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Product List</h1>
            <a href="{{ url('/create-product') }}" class="btn btn-success">Add New Product</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                </tbody>
        </table>
    </div>

    <script>
        // 1. On Page Load, call the API
        document.addEventListener('DOMContentLoaded', function() {
            fetchProducts();
        });

        async function fetchProducts() {
            try {
                // Call your Laravel API
                const response = await fetch('/api/products');
                const result = await response.json();

                // Check if the API call was successful
                if(result.status) {
                    const products = result.data;
                    const tableBody = document.getElementById('product-table-body');
                    
                    tableBody.innerHTML = ''; // Clear loading text

                    // Loop through products and create rows
                    products.forEach(product => {
                        const row = `
                            <tr>
                                <td>${product.id}</td>
                                <td>
                                    ${product.image 
                                      ? `<img src="${product.image}" width="50" height="50" style="object-fit:cover;">` 
                                      : 'No Image'}
                                </td>
                                <td>${product.name}</td>
                                <td>$${product.price}</td>
                                <td>${product.description || ''}</td>
                                <td>
                                    <a href="/edit-product/${product.id}" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Simple Delete Function
        async function deleteProduct(id) {
            if(!confirm('Are you sure you want to delete this?')) return;

            try {
                const response = await fetch(`/api/products/${id}`, {
                    method: 'DELETE',
                });
                
                // Reload the table after deleting
                fetchProducts(); 
            } catch (error) {
                alert('Error deleting product');
            }
        }
    </script>

  </body>
</html>