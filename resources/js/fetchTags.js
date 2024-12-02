export default async function fetchTags(searchTerm) {

    let apiurl = `../../api/addTags`;

    const controller = new AbortController();
    const signal = controller.signal;

    let config = {
        signal: signal, // 正確傳遞 signal
        mode: 'cors',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',  // 告訴伺服器數據格式為 JSON
        },
        body: JSON.stringify({
            tags: $('.tags-container:not(.d-none) span').map(function (key, tag) {
                return $(tag).text();
            }).get(),
            type: $('[name="tagModels"] option:selected').val(),
            input: searchTerm
        })
    };

    try {
        // 等待 fetch 完成
        const response = await fetch(apiurl, config);

        // 確保 response 是成功的
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        // 解析 JSON
        const data = await response.json();

        return data;
    } catch (error) {
        console.error('Fetch error:', error);
    }
}