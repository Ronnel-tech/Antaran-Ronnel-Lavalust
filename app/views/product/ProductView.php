<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductView</title>
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
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        /* Container Card */
        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 1000px;
        }

        /* Header Navigation */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }

        .header h4 {
            font-size: 1.5rem;
            color: #1a1a1a;
        }

        .nav-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: #3182ce;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #2b6cb0;
        }

        .btn-logout {
            background-color: #e2e8f0;
            color: #4a5568;
        }

        .btn-logout:hover {
            background-color: #cbd5e0;
            color: #2d3748;
        }

        .logout-form,
        .delete-form {
            display: inline;
        }

        .btn-action {
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
            margin-right: 0.25rem;
        }

        .btn-edit {
            background-color: #edf2f7;
            color: #2b6cb0;
        }

        .btn-edit:hover {
            background-color: #e2e8f0;
        }

        .btn-delete {
            background-color: #fff5f5;
            color: #e53e3e;
        }

        .btn-delete:hover {
            background-color: #fed7d7;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            margin-top: 1rem;
        }

        th {
            background-color: #f7fafc;
            color: #4a5568;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #edf2f7;
            font-size: 0.875rem;
            color: #2d3748;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: #718096;
        }

        /* Toast Notification Styling */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 260px;
            padding: 0.875rem 1.25rem;
            color: #ffffff;
            background: #38a169;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-size: 0.875rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification button {
            color: inherit;
            background: transparent;
            border: 0;
            cursor: pointer;
            font-size: 1.25rem;
            line-height: 1;
            margin-left: 1rem;
            opacity: 0.8;
        }

        .notification button:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if (!empty($notification)): ?>
            <div class="notification" role="status" id="notification">
                <span><?= htmlspecialchars($notification, ENT_QUOTES, 'UTF-8'); ?></span>
                <button type="button" onclick="document.getElementById('notification').remove();" aria-label="Close notification">&times;</button>
            </div>
        <?php endif; ?>

        <div class="header">
            <h4>Products</h4>
            <div class="nav-actions">
                <?php if ($user_role === 'admin'): ?>
                    <a href="<?= site_url('/products/create'); ?>" class="btn btn-primary">Add Product</a>
                <?php endif; ?>
                <span><?= htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?></span>
                <form class="logout-form" action="<?= site_url('/logout'); ?>" method="post">
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <?php if ($user_role === 'admin'): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td class="empty-state" colspan="<?= $user_role === 'admin' ? 6 : 5; ?>">No products are available yet.</td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><strong><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?></td>
                            
                            <?php if ($user_role === 'admin'): ?>
                                <td>
                                    <a href="<?= site_url('/products/' . $product['id'] . '/edit'); ?>" class="btn btn-action btn-edit">Edit</a>
                                    <form class="delete-form" action="<?= site_url('/products/' . $product['id'] . '/delete'); ?>" method="post" onsubmit="return confirm('Delete this product?');">
                                        <button type="submit" class="btn btn-action btn-delete">Delete</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($notification)): ?>
        <script>
            window.setTimeout(function () {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.remove();
                }
            }, 4000);
        </script>
    <?php endif; ?>

</body>
</html>


