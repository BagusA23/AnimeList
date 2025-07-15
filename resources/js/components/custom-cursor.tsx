import { motion, useMotionValue, useSpring } from "framer-motion";
import { useEffect, useRef, useState } from "react";

export default function IosPointer() {
  const pointerX = useMotionValue(0);
  const pointerY = useMotionValue(0);

  const x = useSpring(pointerX, { stiffness: 1200, damping: 20 });
  const y = useSpring(pointerY, { stiffness: 1200, damping: 20 });

  const [hovering, setHovering] = useState(false);
  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const move = (e: MouseEvent) => {
      pointerX.set(e.clientX);
      pointerY.set(e.clientY);
    };

    window.addEventListener("mousemove", move);
    return () => window.removeEventListener("mousemove", move);
  }, []);

  // Hover detection
  useEffect(() => {
    const hoverTargets = document.querySelectorAll("[data-hover]");
    hoverTargets.forEach((el) => {
      el.addEventListener("mouseenter", () => setHovering(true));
      el.addEventListener("mouseleave", () => setHovering(false));
    });

    return () => {
      hoverTargets.forEach((el) => {
        el.removeEventListener("mouseenter", () => setHovering(true));
        el.removeEventListener("mouseleave", () => setHovering(false));
      });
    };
  }, []);

  return (
    <motion.div
      ref={ref}
      className={`pointer-events-none fixed left-0 top-0 z-50 rounded-full transition-all ${
        hovering ? "h-10 w-10 bg-zinc-900" : "h-4 w-4 bg-zinc-500"
      }`}
      style={{
        x,
        y,
        translateX: "-50%",
        translateY: "-50%",
        mixBlendMode: "difference",
      }}
    />
  );
}
