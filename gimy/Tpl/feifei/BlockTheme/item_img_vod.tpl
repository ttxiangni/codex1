<div class="vod-item">
    <a href="{field:url}">
        <div class="vod-thumb">
            <img src="{field:pic}" alt="{field:name}" loading="lazy">
            {if condition="$field['vod_remarks']"}
            <span class="vod-remark">{field:vod_remarks}</span>
            {/if}
            {if condition="$field['vod_score'] > 0"}
            <span class="vod-score">{field:vod_score}</span>
            {/if}
        </div>
        <h4 class="vod-title">{field:name}</h4>
    </a>
</div>