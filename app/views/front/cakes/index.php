<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradition Sucrée - Gâteaux Marocains Authentiques</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#BE8E5C',
                        secondary: '#594D46',
                        accent: '#EAD7C7'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-accent/10">
    <?php include_once __DIR__ . '/../../partials/header.php'; ?>

    <!-- Hero Section -->
    <section class="relative h-[600px] bg-cover bg-center" style="background-image: url('/assets/images/hero-bg.jpg');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="text-white max-w-2xl">
                <h1 class="text-5xl font-bold mb-6">Découvrez l'Authenticité des Gâteaux Marocains</h1>
                <p class="text-xl mb-8">Des recettes traditionnelles transmises de génération en génération</p>
                <a href="/catalogue" class="bg-primary text-white px-8 py-3 rounded-lg text-lg hover:bg-primary/90">Voir le catalogue</a>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <!-- Featured Categories -->
<section class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center mb-12 text-secondary">Nos Catégories Phares</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <?php foreach ($categories as $category): ?>
            <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-primary/20">
                <h3 class="text-xl font-bold text-primary"><?= htmlspecialchars($category['name']) ?></h3>
                <p class="text-secondary/80"><?= htmlspecialchars($category['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Best Sellers -->
<section class="container mx-auto px-4 py-16 bg-accent/5">
    <h2 class="text-3xl font-bold text-center mb-12 text-secondary">Nos Meilleures Ventes</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php foreach ($featuredCakes as $cake): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="<?= htmlspecialchars($cake['image_url']) ?>" alt="<?= htmlspecialchars($cake['name']) ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary"><?= htmlspecialchars($cake['name']) ?></h3>
                    <p class="text-secondary/80"><?= htmlspecialchars($cake['description']) ?></p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-primary font-bold"><?= number_format($cake['price'], 2) ?> €</span>
                        <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/90">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


    <!-- Best Sellers -->
    <section class="container mx-auto px-4 py-16 bg-accent/5">
        <h2 class="text-3xl font-bold text-center mb-12 text-secondary">Nos Meilleures Ventes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Product cards with new color scheme -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary">Produit Phare</h3>
                    <p class="text-secondary/80">Description du produit</p>
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded hover:bg-primary/90">
                        Voir détails
                    </button>
                </div>
            </div>
            <!-- Add more product cards -->
        </div>
    </section>

    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>
</body>
</html>
