$('.delete-btn').click(function(event) {
    event.preventDefault();
    var productId = $(this).data('id');
    var row = $(this).closest('tr');

    if (!confirm('本当に削除しますか？')) {
        return;
    }

    // CSRFトークンを取得
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // AJAXリクエストを送信
    $.ajax({
        url: '/STEP7/public/product/delete/' + productId,
        method: 'POST',
        data: {
            _token: csrfToken,
        },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            if (response.success) {
                row.fadeOut();
                console.log(response.redirect_url);
                window.location.href = response.redirect_url;
            } else {
                alert('削除に失敗しました: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Request URL:', '/product/delete/' + productId);
            console.log('AJAX Error:', error);
            console.log('Status:', status);
            console.log('Response Text:', xhr.responseText);
            alert('削除中にエラーが発生しました: ' + error);
        }
    });
});


$('.search-btn').click(function() {

    if (!confirm('検索しますか？')) {
        return;
    }
    var searchProductName = $('input[name="searchProductName"]').val();
    var searchCompanyId = $('select[name="searchCompanyId"]').val();
    var maxPrice = $('input[name="maxPrice"]').val();
    var minPrice = $('input[name="minPrice"]').val();
    var maxStock = $('input[name="maxStock"]').val();
    var minStock = $('input[name="minStock"]').val();

    // CSRFトークンを取得
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // AJAXリクエストを送信
    $.ajax({
        url: '/STEP7/public/product/search',
        method: 'POST',
        data: {
            _token: csrfToken,
            searchProductName: searchProductName,
            searchCompanyId: searchCompanyId,
            maxPrice: maxPrice,
            minPrice: minPrice,
            maxStock: maxStock,
            minStock: minStock
        },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            console.log(maxPrice);
            console.log(minPrice);

            if (response.success) {
                // 新しいページに遷移する前に、ページネーションを更新する
                $('.product-table tbody').html(response.productList);
                // ページネーションを更新
                $('.pagination').html(response.pagination);
                alert('検索できました');
            } else {
                alert('検索に失敗しました: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Request URL:', '/product/search');
            console.log('AJAX Error:', error);
            console.log('Status:', status);
            console.log('Response Text:', xhr.responseText);
            alert('検索中にエラーが発生しました: ' + error);
        }
    });
});

$(document).ready(function() {
    // テーブルをsortableにする
    $("#table").tablesorter();
});