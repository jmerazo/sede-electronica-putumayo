<div class="news-section">
    <h2 class="news-title">Últimas Noticias</h2>
    
    @if($publications->isNotEmpty())
        <div class="news-container">
            <!-- Noticia destacada -->
            <div class="featured-news">
                <img src="{{ asset('storage/' . $publications->first()->image) }}" alt="{{ $publications->first()->title }}" class="featured-image">
                <div class="featured-content">
                    <h3 class="featured-title">{{ $publications->first()->title }}</h3>
                    <p class="featured-date">{{ \Carbon\Carbon::parse($publications->first()->date)->format('d/m/Y') }}</p>
                    <p class="featured-description">{{ Str::limit($publications->first()->description, 200) }}</p>
                    <a href="{{ route('publications.show', $publications->first()->id) }}" class="featured-read-more">Leer más</a>
                </div>
            </div>

            <!-- Lista de noticias pequeñas -->
            <div class="news-list">
                @foreach($publications->slice(1) as $publication)
                    <div class="news-item">
                        <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}" class="news-thumbnail">
                        <div class="news-item-content">
                            <a href="{{ route('publications.show', $publication->id) }}" class="news-item-title">{{ $publication->title }}</a>
                            <p class="news-item-date">{{ \Carbon\Carbon::parse($publication->date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="no-news">No hay noticias disponibles en este momento.</p>
    @endif

    <!-- Botón de ver más noticias -->
    <div class="news-more">
        <a href="{{ route('publications') }}" class="news-more-btn">Ver más noticias</a>
    </div>
</div>

<style>
.news-section {
    padding: 2rem;
    background-color: #f8f9fa;
    max-width: 900px;
    margin: auto;
}

.news-title {
    font-size: 2rem;
    font-weight: bold;
    color: #004884;
    text-align: center;
    margin-bottom: 2rem;
}

.news-container {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.featured-news {
    flex: 2;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.featured-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.featured-content {
    padding: 1rem;
    background-color: #fff;
}

.featured-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #004884;
}

.featured-date {
    font-size: 0.9rem;
    color: #888;
    margin-top: 0.5rem;
}

.featured-description {
    margin-top: 1rem;
    color: #555;
}

.featured-read-more {
    display: inline-block;
    margin-top: 1rem;
    font-weight: bold;
    color: #004884;
    text-decoration: none;
}

.news-list {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.news-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.news-thumbnail {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}

.news-item-content {
    flex: 1;
}

.news-item-title {
    font-size: 1rem;
    font-weight: bold;
    color: #004884;
    text-decoration: none;
}

.news-item-title:hover {
    color: #007bff;
}

.news-item-date {
    font-size: 0.8rem;
    color: #888;
}

.no-news {
    text-align: center;
    font-size: 1rem;
    color: #666;
}

.news-more {
    text-align: center;
    margin-top: 2rem;
}

.news-more-btn {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background-color: #004884;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.news-more-btn:hover {
    background-color: #007bff;
}
</style>
