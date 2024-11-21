<!-- resources/views/includes/footer.blade.php -->
<footer class="bg-gray-800 p-4 mt-8">
    <div class="container mx-auto text-center text-gray-300">
        <p>&copy; {{ date('Y') }} Minha Aplicação. Todos os direitos reservados.</p>
        <div class="mt-4">
            <a href="{{ url('/politica-de-privacidade') }}" class="text-gray-400 hover:text-white">Política de Privacidade</a> |
            <a href="{{ url('/termos-de-uso') }}" class="text-gray-400 hover:text-white">Termos de Uso</a>
        </div>
    </div>
</footer>
