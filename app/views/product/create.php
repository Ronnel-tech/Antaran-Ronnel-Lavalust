<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        /* Base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        /* Container Card */
        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
        }

        .container h2 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #1a1a1a;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1rem;
            color: #2d3748;
            background-color: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        /* Submit Button */
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: #3182ce;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            background-color: #2b6cb0;
        }

        .btn-primary:active {
            background-color: #2c5282;
        }

        /* Back Link */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            color: #4a5568;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #3182ce;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add Product</h2>

        <?php if (!empty($errors)): ?>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="<?= site_url('/products'); ?>" method="post">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="e.g. Wireless Mouse" value="<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter product details..." required><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" placeholder="0.00" value="<?= htmlspecialchars((string) $product['price'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="0" step="1" placeholder="0" value="<?= htmlspecialchars((string) $product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <button type="submit" class="btn-primary">Add Product</button>
        </form>

        <a href="<?= site_url('/products'); ?>" class="back-link">&larr; Back to products</a>
    </div>

</body>
</html>
