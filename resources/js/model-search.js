// JavaScript للبحث التلقائي وجلب منتجات الموديل
function handleModelInput(modelName, category, subCategory, brand) {
    if (!modelName || modelName.length < 3) {
        document.getElementById('model-products-container').innerHTML = '';
        return;
    }
    
    fetch(`/api/model/${encodeURIComponent(modelName)}?category=${encodeURIComponent(category)}&sub_category=${encodeURIComponent(subCategory)}&brand=${encodeURIComponent(brand)}`)
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

// فتح وإغلاق قائمة الموديلات
function toggleModelList() {
    const select = document.getElementById('model-select');
    if (select) {
        if (select.style.display === 'none' || select.style.display === '') {
            select.style.display = 'block';
            select.focus();
        } else {
            select.style.display = 'none';
        }
    }
}

// إغلاق القائمة عند النقر خارجها
document.addEventListener('click', function(e) {
    const select = document.getElementById('model-select');
    const container = document.getElementById('model-products-container');
    
    if (select && container && !select.contains(e.target) && e.target !== select) {
        select.style.display = 'none';
    }
});
