<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        .form-card {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
        }

        .form-card h2 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #1a1a1a;
        }

        /* Error List Styling */
        .error-list {
            background-color: #fde8e8;
            color: #e53e3e;
            padding: 0.875rem 1rem 0.875rem 2.25rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            border: 1px solid #f8b4b4;
        }

        .error-list li {
            margin-bottom: 0.25rem;
        }

        .error-list li:last-child {
            margin-bottom: 0;
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

        input[type="text"],
        input[type="number"],
        textarea {
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

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        /* Submit Button */
        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #2b6cb0;
        }

        button[type="submit"]:active {
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

    <div class="form-card">
        <h2>Edit Product</h2>

        <?php if (!empty($errors)): ?>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="<?= site_url('/products/' . $product['id']); ?>" method="post">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="<?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="0" step="1" value="<?= htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <button type="submit">Update Product</button>
        </form>

        <a href="<?= site_url('/products'); ?>" class="back-link">&larr; Back to products</a>
    </div>

</body>
</html>
