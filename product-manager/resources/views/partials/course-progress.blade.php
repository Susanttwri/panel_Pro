@php
    $progress = min(100, max(0, (int) ($enrollment->progress ?? 0)));
    $remaining = 100 - $progress;
    $quizBest = (int) ($enrollment->quiz_best_score ?? 0);
@endphp
<div class="progress-block" style="width:100%;">
    <div style="display:flex; justify-content:space-between; font-size:12px; font-weight:600; margin-bottom:8px; color:var(--muted);">
        <span><i class="fas fa-chart-line"></i> Completed: {{ $progress }}%</span>
        <span><i class="fas fa-hourglass-half"></i> Remaining: {{ $remaining }}%</span>
    </div>
    <div style="height:10px; background:#e5e7eb; border-radius:999px; overflow:hidden;">
        <div style="height:100%; width:{{ $progress }}%; background:linear-gradient(90deg,#111,#4b5563); border-radius:999px; transition:width .4s ease;"></div>
    </div>
    @if($quizBest > 0)
        <div style="font-size:11px; color:var(--muted); margin-top:6px;">Best quiz score: {{ $quizBest }}%</div>
    @endif
</div>
