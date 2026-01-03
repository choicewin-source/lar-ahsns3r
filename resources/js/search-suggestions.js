// البحث التلقائي مع اقتراحات
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('[wire\\:model\\.live\\.debounce\\.300ms="search"]');
    const suggestionsContainer = document.getElementById('search-suggestions');
    
    if (!searchInput || !suggestionsContainer) return;

    let searchTimeout;
    let currentRequest = null;

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        // إلغاء الطلب السابق
        if (currentRequest) {
            currentRequest.abort();
        }
        
        // إلغاء التايمر السابق
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        if (query.length < 2) {
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.classList.add('hidden');
            return;
        }
        
        // انتظار قبل البحث
        searchTimeout = setTimeout(() => {
            currentRequest = fetch(`/api/search?q=${encodeURIComponent(query)}&category=${encodeURIComponent(selectedCategory || '')}&sub_category=${encodeURIComponent(selectedSubCategory || '')}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        suggestionsContainer.innerHTML = '';
                        suggestionsContainer.classList.remove('hidden');
                        
                        data.forEach(product => {
                            const item = document.createElement('div');
                            item.className = 'px-4 py-3 hover:bg-gray-100 cursor-pointer border-b border-gray-100 search-suggestion-item';
                            item.innerHTML = `
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">${product.name}</div>
                                        <div class="text-sm text-gray-500">${product.shop_name} • ${product.city}</div>
                                    </div>
                                    <div class="text-lg font-bold text-red-600">${product.price}</div>
                                </div>
                            `;
                            
                            item.addEventListener('click', function() {
                                searchInput.value = product.name;
                                suggestionsContainer.innerHTML = '';
                                suggestionsContainer.classList.add('hidden');
                                searchInput.dispatchEvent(new Event('input'));
                            });
                            
                            suggestionsContainer.appendChild(item);
                        });
                    } else {
                        suggestionsContainer.innerHTML = '';
                        suggestionsContainer.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    suggestionsContainer.innerHTML = '';
                    suggestionsContainer.classList.add('hidden');
                });
        }, 300);
    });

    // إغلاق الاقتراحات عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (!suggestionsContainer.contains(e.target) && e.target !== searchInput) {
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.classList.add('hidden');
        }
    });
});

// جلب منتجات الموديل عند الكتابة
function loadModelProducts(modelName) {
    if (!modelName || modelName.length < 3) return;
    
    const category = document.querySelector('[wire\\:model\\.live="category"]')?.value;
    const subCategory = document.querySelector('[wire\\:model\\.live="sub_category"]')?.value;
    
    if (!category || !subCategory) return;
    
    fetch(`/api/model/${encodeURIComponent(modelName)}?category=${encodeURIComponent(category)}&sub_category=${encodeURIComponent(subCategory)}`)
        .then(response => response.json())
        .then(products => {
            if (products.error) {
                console.error('Error:', products.error);
                return;
            }
            
            const container = document.getElementById('model-products-container');
            if (container) {
                if (products.length > 0) {
                    container.innerHTML = `
                        <div class="bg-white rounded-xl shadow-lg p-4 mb-4">
                            <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <span>📋</span>
                                جميع ${modelName} المتاحة (${products.length})
                            </h4>
                            <div class="space-y-2 max-h-60 overflow-y-auto">
                                ${products.map((product, index) => `
                                    <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded cursor-pointer model-product-item" data-id="${product.id}">
                                        <div class="flex-1">
                                            <div class="font-medium text-gray-900">${product.name}</div>
                                            <div class="text-sm text-gray-500">${product.shop_name} • ${product.city}</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="text-lg font-bold text-red-600">${product.price}</div>
                                            <div class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded">${product.reference_code}</div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    
                    // إضافة حدث النقر للمنتجات
                    container.querySelectorAll('.model-product-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const productId = this.dataset.id;
                            window.location.href = `/product/${productId}`;
                        });
                    });
                } else {
                    container.innerHTML = `
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-4">
                            <div class="text-center text-yellow-800">
                                <div class="text-2xl mb-2">🔍</div>
                                <div class="font-medium">لا توجد منتجات لهذا الموديل</div>
                                <div class="text-sm mt-1">جرب البحث عن اسم آخر</div>
                            </div>
                        </div>
                    `;
                }
            }
        })
        .catch(error => {
            console.error('Error loading model products:', error);
        });
}
