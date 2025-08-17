<!DOCTYPE html>
<html>
<head>
    <title>Search Products</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header>
    <h1>Product Catalogue System – User Dashboard</h1>
    <div>
        <a href="index.php?action=user_dashboard">Back</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<input id="search" type="text" placeholder="Type to search products...">

<div class="grid" id="productGrid">
    <?php foreach ($products as $p): ?>
        <div class="card" data-id="<?= $p['product_id'] ?>">
            <img src="../assets/<?= htmlspecialchars($p['product_image']) ?>" alt="">
            <p class="name"><?= htmlspecialchars($p['product_name']) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<script>
    const search = document.getElementById('search');
    const cards = document.querySelectorAll('.card');

    function filterCards() {
        const term = search.value.toLowerCase().trim();
        if (!term) {
            cards.forEach(c => c.style.display = 'none');
            return;
        }
        cards.forEach(c => {
            const name = c.querySelector('.name').textContent.toLowerCase();
            c.style.display = name.includes(term) ? 'block' : 'none';
        });
    }

    search.addEventListener('input', filterCards);

    cards.forEach(c => {
        c.addEventListener('click', () => {
            const id = c.getAttribute('data-id');
            window.location.href = `index.php?action=product_detail&id=${id}`;
        });
    });
</script>
</body>
</html>
