<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        .card { 
            display: none; 
            width: 200px; 
            background: #fff; 
            border: 1px solid #ddd; 
            padding: 1rem; 
            margin: 1rem; 
            text-align: center; 
        }
        .card h3 { margin-bottom: 0.5rem; }
        .card p { margin-bottom: 0.5rem; font-size: 0.9rem; }
        .card .price { font-weight: bold; color: #007bff; }
    </style>
</head>
<body>
<header>
    <h1>Product Search & Filter</h1>
    <div>
        <a href="index.php?action=user_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<input type="text" id="search" placeholder="Search products...">
<div id="no-results" style="display: none;">No products found matching your search.</div>

<div class="grid">
    <?php foreach ($products as $product): ?>
    <div class="card" data-name="<?= strtolower($product['product_name']) ?>">
        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
        <p><?= htmlspecialchars($product['product_type']) ?></p>
        <p class="price">$<?= number_format($product['product_price'], 2) ?></p>
        <a href="index.php?action=product_detail&id=<?= $product['product_id'] ?>" class="btn">View Details</a>
    </div>
    <?php endforeach; ?>
</div>

<script>
document.getElementById('search').addEventListener('keyup', function() {
    const query = this.value.toLowerCase();
    const cards = document.querySelectorAll('.card');
    const noResults = document.getElementById('no-results');
    let hasResults = false;

    cards.forEach(card => {
        const name = card.getAttribute('data-name');
        if (name.includes(query)) {
            card.style.display = 'block';
            hasResults = true;
        } else {
            card.style.display = 'none';
        }
    });

    noResults.style.display = hasResults ? 'none' : 'block';
});
</script>
</body>
</html>
