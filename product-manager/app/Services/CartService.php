<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Collection;

class CartService
{
    public const SESSION_KEY = 'cart';

    protected function cartIds(): array
    {
        $ids = session(self::SESSION_KEY, []);

        return array_values(array_map('intval', is_array($ids) ? $ids : []));
    }

    protected function saveCart(array $ids): void
    {
        session([self::SESSION_KEY => array_values(array_unique(array_map('intval', $ids)))]);
        session()->save();
    }

    public function items(): Collection
    {
        $ids = $this->cartIds();

        if (empty($ids)) {
            return collect();
        }

        $courses = Course::with('instructor')
            ->withCount('enrollments')
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->get();

        return collect($ids)
            ->map(fn ($id) => $courses->firstWhere('id', $id))
            ->filter();
    }

    public function count(): int
    {
        return count($this->cartIds());
    }

    public function isInCart(int $courseId): bool
    {
        return in_array($courseId, $this->cartIds(), true);
    }

    public function add(Course $course): ?string
    {
        if (!$course->is_active) {
            return 'This course is not available.';
        }

        $course->loadCount('enrollments');

        if ($course->enrollments_count >= $course->max_students) {
            return 'This course is full.';
        }

        if ($course->deadline && $course->deadline->isPast()) {
            return 'The enrollment deadline has passed.';
        }

        $cart = $this->cartIds();

        if (in_array($course->id, $cart, true)) {
            return 'This course is already in your cart.';
        }

        $cart[] = $course->id;
        $this->saveCart($cart);

        return null;
    }

    public function remove(int $courseId): void
    {
        $this->saveCart(array_values(array_filter(
            $this->cartIds(),
            fn ($id) => $id !== $courseId
        )));
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
        session()->save();
    }

    public function total(): float
    {
        return (float) $this->items()->sum('price');
    }

    public function canPurchase(Course $course): bool
    {
        if (!$course->is_active) {
            return false;
        }

        $course->loadCount('enrollments');

        return $course->enrollments_count < $course->max_students
            && (!$course->deadline || !$course->deadline->isPast());
    }
}
