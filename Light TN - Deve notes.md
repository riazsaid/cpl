# **Final developer handoff, VistaHaven-style build spec**

Reference website  
[https://vistahaven.framer.website](https://vistahaven.framer.website)

## **1\) Visual direction**

Build this as a luxury/editorial real-estate landing page with:

* dark hero image overlay  
* high-contrast serif headline  
* refined sans-serif body text  
* rounded cards  
* soft borders  
* restrained gold accent  
* large spacing  
* subtle motion only

The reference hero includes:

* headline: “Find Your Perfect Home Today”  
* supporting paragraph  
* CTA  
* stats: 200+, 70+, $10M+  
* a horizontally moving social-proof strip with repeated “10+ Featured Agents” and “5 / 5” chips. 

---

## **2\) Recommended design token**

These are **matched-by-eye** tokens for dev use.

:root {  
 /\* Colors \*/  
 \--bg: \#0b0b0b;  
 \--bg-soft: \#111111;  
 \--panel: rgba(255, 255, 255, 0.06);  
 \--panel-strong: rgba(255, 255, 255, 0.08);  
 \--border: rgba(255, 255, 255, 0.12);  
 \--border-strong: rgba(255, 255, 255, 0.18);  
 \--text: \#f5f2eb;  
 \--text-soft: rgba(245, 242, 235, 0.78);  
 \--text-muted: rgba(245, 242, 235, 0.56);  
 \--accent: \#d4b06a;  
 \--accent-soft: rgba(212, 176, 106, 0.18);  
 \--shadow: 0 20px 60px rgba(0, 0, 0, 0.28);

 /\* Type \*/  
 \--font-display: "Cormorant Garamond", "Playfair Display", Georgia, serif;  
 \--font-body: Inter, ui-sans-serif, system-ui, \-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;

 /\* Sizes \*/  
 \--h1: clamp(3rem, 7vw, 6.4rem);  
 \--h2: clamp(2rem, 4vw, 3.4rem);  
 \--h3: clamp(1.35rem, 2vw, 1.85rem);  
 \--body-lg: 1.125rem;  
 \--body: 1rem;  
 \--small: 0.875rem;  
 \--tiny: 0.75rem;

 /\* Leading \*/  
 \--lh-tight: 0.96;  
 \--lh-heading: 1.02;  
 \--lh-body: 1.65;

 /\* Radius \*/  
 \--radius-sm: 16px;  
 \--radius-md: 22px;  
 \--radius-lg: 30px;  
 \--radius-pill: 999px;

 /\* Layout \*/  
 \--container: 1280px;  
 \--gutter: clamp(20px, 4vw, 36px);  
 \--section-space: clamp(72px, 10vw, 140px);  
 \--grid-gap: clamp(18px, 2vw, 28px);

 /\* Motion \*/  
 \--ease-premium: cubic-bezier(0.22, 1, 0.36, 1);  
 \--dur-fast: 0.3s;  
 \--dur-med: 0.55s;  
 \--dur-slow: 0.8s;  
}  
---

## **3\) Fonts and exact sizing guidance**

Use:

* **Display/headlines**: Cormorant Garamond SemiBold or Playfair Display SemiBold  
* **Body/UI**: Inter 400 / 500 / 600

### **Typography rules**

body {  
 font-family: var(--font-body);  
 font-size: var(--body);  
 line-height: var(--lh-body);  
 color: var(--text);  
 background: var(--bg);  
 \-webkit-font-smoothing: antialiased;  
 text-rendering: optimizeLegibility;  
}

h1, h2, h3, .display {  
 font-family: var(--font-display);  
 letter-spacing: \-0.02em;  
 color: var(--text);  
 margin: 0;  
}

h1 {  
 font-size: var(--h1);  
 line-height: var(--lh-tight);  
 font-weight: 600;  
}

h2 {  
 font-size: var(--h2);  
 line-height: var(--lh-heading);  
 font-weight: 600;  
}

h3 {  
 font-size: var(--h3);  
 line-height: 1.1;  
 font-weight: 600;  
}

p {  
 margin: 0;  
 color: var(--text-soft);  
}

.eyebrow {  
 font-size: 0.82rem;  
 letter-spacing: 0.18em;  
 text-transform: uppercase;  
 color: var(--text-muted);  
 font-weight: 600;  
}

.body-lg {  
 font-size: var(--body-lg);  
 line-height: 1.75;  
 color: var(--text-soft);  
}

.stat-number {  
 font-family: var(--font-display);  
 font-size: clamp(2rem, 3vw, 3.1rem);  
 line-height: 0.95;  
 color: var(--text);  
 font-weight: 600;  
}

.stat-label {  
 margin-top: 10px;  
 font-size: 0.92rem;  
 color: var(--text-muted);  
}  
---

## **4\) Layout and spacing system**

.container {  
 width: min(100% \- (var(--gutter) \* 2), var(--container));  
 margin-inline: auto;  
}

.section {  
 padding: var(--section-space) 0;  
}

.section-head {  
 display: grid;  
 gap: 14px;  
 margin-bottom: clamp(28px, 4vw, 48px);  
}

.grid-2 {  
 display: grid;  
 grid-template-columns: 1.1fr 0.9fr;  
 gap: var(--grid-gap);  
}

.grid-3 {  
 display: grid;  
 grid-template-columns: repeat(3, minmax(0, 1fr));  
 gap: var(--grid-gap);  
}

.grid-4 {  
 display: grid;  
 grid-template-columns: repeat(4, minmax(0, 1fr));  
 gap: var(--grid-gap);  
}

@media (max-width: 1024px) {  
 .grid-2,  
 .grid-3,  
 .grid-4 {  
   grid-template-columns: 1fr;  
 }  
}

### **Section spacing targets**

Use these as the default vertical rhythm:

* hero top padding: `32px`  
* hero content bottom padding: `64px`  
* marquee margin-top under stats: `32px`  
* section top/bottom padding: `96px` desktop, `72px` tablet, `56px` mobile  
* card internal padding: `22px`  
* big image cards: `26px`  
* button vertical padding: `14px`  
* button horizontal padding: `22px`

---

## **5\) Hero spec**

The hero on the reference page contains the H1, supporting copy, CTA, stat row, and marquee strip. 

### **Hero structure**

* full viewport or `min-height: 100svh`  
* large left content column  
* background image with dark overlay  
* content vertically centered  
* stats row below CTA  
* marquee strip below stats  
* nav overlaid at top

### **Hero CSS**

.hero {  
 position: relative;  
 min-height: 100svh;  
 display: flex;  
 align-items: center;  
 overflow: clip;  
 background:  
   linear-gradient(180deg, rgba(5,5,5,0.38), rgba(5,5,5,0.62)),  
   linear-gradient(90deg, rgba(8,8,8,0.72) 0%, rgba(8,8,8,0.40) 38%, rgba(8,8,8,0.24) 100%);  
}

.hero-media {  
 position: absolute;  
 inset: 0;  
 z-index: 0;  
}

.hero-media img,  
.hero-media video {  
 width: 100%;  
 height: 100%;  
 object-fit: cover;  
}

.hero-inner {  
 position: relative;  
 z-index: 1;  
 width: min(100% \- (var(--gutter) \* 2), var(--container));  
 margin-inline: auto;  
 padding-top: 112px;  
 padding-bottom: 56px;  
}

.hero-content {  
 max-width: 760px;  
 display: grid;  
 gap: 22px;  
}

.hero-copy {  
 max-width: 620px;  
}

.hero-actions {  
 display: flex;  
 gap: 14px;  
 align-items: center;  
 flex-wrap: wrap;  
 margin-top: 6px;  
}

.hero-stats {  
 display: grid;  
 grid-template-columns: repeat(3, minmax(0, max-content));  
 gap: clamp(22px, 4vw, 52px);  
 margin-top: 18px;  
 align-items: end;  
}

@media (max-width: 768px) {  
 .hero-inner {  
   padding-top: 96px;  
   padding-bottom: 40px;  
 }

 .hero-content {  
   gap: 18px;  
 }

 .hero-stats {  
   grid-template-columns: 1fr;  
   gap: 18px;  
   margin-top: 10px;  
 }  
}  
---

## **6\) Button system**

.btn {  
 display: inline-flex;  
 align-items: center;  
 justify-content: center;  
 gap: 10px;  
 min-height: 52px;  
 padding: 14px 22px;  
 border-radius: var(--radius-pill);  
 font-family: var(--font-body);  
 font-size: 0.96rem;  
 font-weight: 600;  
 text-decoration: none;  
 transition:  
   transform var(--dur-fast) var(--ease-premium),  
   background-color var(--dur-fast) var(--ease-premium),  
   border-color var(--dur-fast) var(--ease-premium),  
   box-shadow var(--dur-fast) var(--ease-premium);  
}

.btn-primary {  
 color: \#121212;  
 background: var(--text);  
 box-shadow: 0 10px 30px rgba(0,0,0,0.18);  
}

.btn-primary:hover {  
 transform: translateY(-2px);  
}

.btn-ghost {  
 color: var(--text);  
 background: rgba(255,255,255,0.06);  
 border: 1px solid var(--border);  
}

.btn-ghost:hover {  
 background: rgba(255,255,255,0.1);  
 transform: translateY(-2px);  
}  
---

## **7\) Infinite top marquee, matched implementation**

The visible page shows the repeating chips and social-proof row directly under the hero stats. 

### **`TopMarquee.tsx`**

import React from "react";  
import "./top-marquee.css";

type Item \=  
 | { type: "agents"; text: string }  
 | { type: "rating"; text: string };

const items: Item\[\] \= \[  
 { type: "agents", text: "10+ Featured Agents" },  
 { type: "rating", text: "5 / 5" },  
 { type: "agents", text: "10+ Featured Agents" },  
 { type: "rating", text: "5 / 5" },  
\];

function AvatarStack() {  
 return (  
   \<div className="marquee-avatars" aria-hidden="true"\>  
     \<span className="marquee-avatar" /\>  
     \<span className="marquee-avatar" /\>  
     \<span className="marquee-avatar" /\>  
     \<span className="marquee-avatar" /\>  
   \</div\>  
 );  
}

function RatingStack() {  
 return (  
   \<div className="marquee-stars" aria-hidden="true"\>  
     \<span className="star-dot" /\>  
     \<span className="star-dot" /\>  
     \<span className="star-dot" /\>  
     \<span className="star-dot" /\>  
     \<span className="star-dot" /\>  
   \</div\>  
 );  
}

function Chip({ item }: { item: Item }) {  
 return (  
   \<div className="marquee-chip"\>  
     {item.type \=== "agents" ? \<AvatarStack /\> : \<RatingStack /\>}  
     \<span\>{item.text}\</span\>  
   \</div\>  
 );  
}

export default function TopMarquee() {  
 const loop \= \[...items, ...items, ...items\];

 return (  
   \<div className="marquee-shell"\>  
     \<div className="marquee-fade left" /\>  
     \<div className="marquee-fade right" /\>  
     \<div className="marquee-track"\>  
       {loop.map((item, i) \=\> (  
         \<Chip key={i} item={item} /\>  
       ))}  
     \</div\>  
   \</div\>  
 );  
}

### **`top-marquee.css`**

.marquee-shell {  
 position: relative;  
 overflow: hidden;  
 width: 100%;  
 margin-top: 30px;  
 padding: 8px 0;  
}

.marquee-track {  
 display: flex;  
 align-items: center;  
 gap: 18px;  
 width: max-content;  
 animation: marquee-scroll 28s linear infinite;  
 will-change: transform;  
}

.marquee-shell:hover .marquee-track {  
 animation-play-state: paused;  
}

.marquee-chip {  
 display: inline-flex;  
 align-items: center;  
 gap: 12px;  
 height: 52px;  
 padding: 0 16px;  
 border-radius: var(--radius-pill);  
 white-space: nowrap;  
 color: var(--text);  
 font-size: 0.93rem;  
 font-weight: 500;  
 background: rgba(255,255,255,0.08);  
 border: 1px solid rgba(255,255,255,0.14);  
 backdrop-filter: blur(10px);  
 \-webkit-backdrop-filter: blur(10px);  
}

.marquee-avatars {  
 display: flex;  
 align-items: center;  
}

.marquee-avatar {  
 width: 28px;  
 height: 28px;  
 border-radius: 999px;  
 margin-left: \-8px;  
 border: 2px solid rgba(10,10,10,0.92);  
 background:  
   radial-gradient(circle at 35% 35%, \#f3d7c9 0%, \#c99479 45%, \#765342 100%);  
}

.marquee-avatar:first-child {  
 margin-left: 0;  
}

.marquee-stars {  
 display: flex;  
 gap: 4px;  
}

.star-dot {  
 width: 8px;  
 height: 8px;  
 border-radius: 999px;  
 background: var(--accent);  
 box-shadow: 0 0 14px rgba(212,176,106,0.35);  
}

.marquee-fade {  
 position: absolute;  
 top: 0;  
 bottom: 0;  
 width: 92px;  
 z-index: 2;  
 pointer-events: none;  
}

.marquee-fade.left {  
 left: 0;  
 background: linear-gradient(to right, rgba(11,11,11,1), rgba(11,11,11,0));  
}

.marquee-fade.right {  
 right: 0;  
 background: linear-gradient(to left, rgba(11,11,11,1), rgba(11,11,11,0));  
}

@keyframes marquee-scroll {  
 from { transform: translateX(0); }  
 to { transform: translateX(-33.333%); }  
}

@media (max-width: 768px) {  
 .marquee-track {  
   animation-duration: 36s;  
 }

 .marquee-chip {  
   height: 48px;  
   padding: 0 14px;  
   font-size: 0.88rem;  
 }

 .marquee-avatar {  
   width: 24px;  
   height: 24px;  
 }  
}

@media (prefers-reduced-motion: reduce) {  
 .marquee-track {  
   animation: none;  
 }  
}  
---

## **8\) Hero motion system**

### **`motion.ts`**

export const easePremium \= \[0.22, 1, 0.36, 1\];

export const fadeUp \= {  
 hidden: { opacity: 0, y: 40, filter: "blur(8px)" },  
 show: (delay \= 0\) \=\> ({  
   opacity: 1,  
   y: 0,  
   filter: "blur(0px)",  
   transition: {  
     duration: 0.8,  
     delay,  
     ease: easePremium,  
   },  
 }),  
};

export const reveal \= {  
 hidden: { opacity: 0, y: 48 },  
 show: {  
   opacity: 1,  
   y: 0,  
   transition: {  
     duration: 0.72,  
     ease: easePremium,  
   },  
 },  
};

### **`Hero.tsx`**

import { motion } from "framer-motion";  
import { fadeUp } from "./motion";  
import TopMarquee from "./TopMarquee";  
import StatsRow from "./StatsRow";

export default function Hero() {  
 return (  
   \<section className="hero"\>  
     \<div className="hero-media"\>  
       \<img src="/images/hero.jpg" alt="" /\>  
     \</div\>

     \<div className="hero-inner"\>  
       \<div className="hero-content"\>  
         \<motion.div  
           className="eyebrow"  
           initial="hidden"  
           animate="show"  
           custom={0.05}  
           variants={fadeUp}  
         \>  
           Premium Real Estate Experience  
         \</motion.div\>

         \<motion.h1  
           initial="hidden"  
           animate="show"  
           custom={0.12}  
           variants={fadeUp}  
         \>  
           Find Your Perfect Home Today  
         \</motion.h1\>

         \<motion.p  
           className="hero-copy body-lg"  
           initial="hidden"  
           animate="show"  
           custom={0.2}  
           variants={fadeUp}  
         \>  
           We provide tailored real estate solutions, guiding you through every  
           step with personalized experiences that meet your unique needs and aspirations.  
         \</motion.p\>

         \<motion.div  
           className="hero-actions"  
           initial="hidden"  
           animate="show"  
           custom={0.28}  
           variants={fadeUp}  
         \>  
           \<a href="\#properties" className="btn btn-primary"\>Explore Properties\</a\>  
         \</motion.div\>

         \<motion.div  
           initial="hidden"  
           animate="show"  
           custom={0.36}  
           variants={fadeUp}  
         \>  
           \<StatsRow /\>  
         \</motion.div\>

         \<motion.div  
           initial="hidden"  
           animate="show"  
           custom={0.44}  
           variants={fadeUp}  
         \>  
           \<TopMarquee /\>  
         \</motion.div\>  
       \</div\>  
     \</div\>  
   \</section\>  
 );  
}  
---

## **9\) Count-up stats**

The visible counters on the page include 200+, 70+, $10M+, and a 90% retention figure in the about section. 

### **`StatsRow.tsx`**

import React, { useEffect, useRef, useState } from "react";

function useInView(threshold \= 0.35) {  
 const ref \= useRef\<HTMLDivElement | null\>(null);  
 const \[seen, setSeen\] \= useState(false);

 useEffect(() \=\> {  
   const node \= ref.current;  
   if (\!node) return;

   const io \= new IntersectionObserver(  
     (\[entry\]) \=\> {  
       if (entry.isIntersecting) {  
         setSeen(true);  
         io.disconnect();  
       }  
     },  
     { threshold }  
   );

   io.observe(node);  
   return () \=\> io.disconnect();  
 }, \[threshold\]);

 return { ref, seen };  
}

function Count({  
 end,  
 prefix \= "",  
 suffix \= "",  
 duration \= 1400,  
}: {  
 end: number;  
 prefix?: string;  
 suffix?: string;  
 duration?: number;  
}) {  
 const { ref, seen } \= useInView();  
 const \[val, setVal\] \= useState(0);

 useEffect(() \=\> {  
   if (\!seen) return;  
   let start: number | null \= null;

   const frame \= (t: number) \=\> {  
     if (\!start) start \= t;  
     const progress \= Math.min((t \- start) / duration, 1);  
     setVal(Math.floor(end \* progress));  
     if (progress \< 1\) requestAnimationFrame(frame);  
   };

   requestAnimationFrame(frame);  
 }, \[seen, end, duration\]);

 return (  
   \<div ref={ref} className="stat-number"\>  
     {prefix}{val}{suffix}  
   \</div\>  
 );  
}

export default function StatsRow() {  
 return (  
   \<div className="hero-stats"\>  
     \<div\>  
       \<Count end={200} suffix="+" /\>  
       \<div className="stat-label"\>Projects Complete\</div\>  
     \</div\>  
     \<div\>  
       \<Count end={70} suffix="+" /\>  
       \<div className="stat-label"\>Happy Clients\</div\>  
     \</div\>  
     \<div\>  
       \<Count end={10} prefix="$" suffix="M+" /\>  
       \<div className="stat-label"\>Project Value\</div\>  
     \</div\>  
   \</div\>  
 );  
}  
---

## **10\) Reusable section reveal**

### **`Reveal.tsx`**

import { motion } from "framer-motion";  
import { reveal } from "./motion";

export default function Reveal({  
 children,  
 className \= "",  
}: {  
 children: React.ReactNode;  
 className?: string;  
}) {  
 return (  
   \<motion.div  
     className={className}  
     variants={reveal}  
     initial="hidden"  
     whileInView="show"  
     viewport={{ once: true, amount: 0.18 }}  
   \>  
     {children}  
   \</motion.div\>  
 );  
}

Use this on:

* services intro  
* service cards  
* featured properties  
* about split  
* mission/vision cards  
* agents section

These are all present in the reference. 

---

## **11\) Card system**

### **Service/property/agent card CSS**

.card {  
 position: relative;  
 border-radius: var(--radius-md);  
 background: rgba(255,255,255,0.045);  
 border: 1px solid var(--border);  
 overflow: clip;  
 box-shadow: none;  
 transition:  
   transform var(--dur-fast) var(--ease-premium),  
   box-shadow var(--dur-fast) var(--ease-premium),  
   border-color var(--dur-fast) var(--ease-premium),  
   background-color var(--dur-fast) var(--ease-premium);  
}

.card:hover {  
 transform: translateY(-8px);  
 border-color: var(--border-strong);  
 box-shadow: var(--shadow);  
 background: rgba(255,255,255,0.06);  
}

.card-media {  
 position: relative;  
 aspect-ratio: 4 / 3;  
 overflow: hidden;  
}

.card-media img {  
 width: 100%;  
 height: 100%;  
 object-fit: cover;  
 transform: scale(1);  
 transition: transform 0.5s var(--ease-premium);  
}

.card:hover .card-media img {  
 transform: scale(1.04);  
}

.card-body {  
 padding: 22px;  
 display: grid;  
 gap: 10px;  
}

.card-kicker {  
 font-size: 0.78rem;  
 letter-spacing: 0.16em;  
 text-transform: uppercase;  
 color: var(--text-muted);  
 font-weight: 600;  
}

.card-title {  
 font-family: var(--font-display);  
 font-size: 1.65rem;  
 line-height: 1.05;  
 color: var(--text);  
}

.card-copy {  
 font-size: 0.97rem;  
 color: var(--text-soft);  
}  
---

## **12\) Featured property card spec**

The page includes a featured properties grid with tag, location, title, bed/bath/sq.ft., and price patterns. 

### **Property metadata row**

.property-meta {  
 display: flex;  
 flex-wrap: wrap;  
 gap: 10px 16px;  
 font-size: 0.87rem;  
 color: var(--text-muted);  
}

.property-price {  
 margin-top: 8px;  
 font-family: var(--font-display);  
 font-size: 1.8rem;  
 line-height: 1;  
 color: var(--text);  
}

### **Property grid spacing**

* grid gap: `24px`  
* image radius: `22px`  
* card padding: `22px`  
* row spacing under section title: `38px`

---

## **13\) About \+ mission/vision layout**

The page includes an about section with “Who We Are,” “Redefining Excellence in Real Estate,” repeated stats, and separate “Our Vision” and “Our Mission” blocks. 

### **About split**

.about-grid {  
 display: grid;  
 grid-template-columns: 1.05fr 0.95fr;  
 gap: clamp(22px, 4vw, 38px);  
 align-items: center;  
}

.about-media {  
 border-radius: var(--radius-lg);  
 overflow: hidden;  
 min-height: 520px;  
}

.about-content {  
 display: grid;  
 gap: 18px;  
}

.about-stats {  
 display: grid;  
 grid-template-columns: repeat(2, minmax(0, max-content));  
 gap: 26px 42px;  
 margin-top: 14px;  
}

@media (max-width: 1024px) {  
 .about-grid {  
   grid-template-columns: 1fr;  
 }

 .about-media {  
   min-height: 360px;  
 }  
}

### **Mission / vision cards**

Use 2-up cards on desktop:

* padding: `24px`  
* icon size: `44px`  
* title size: `1.4rem`  
* copy max width: none

---

## **14\) Agents row / carousel**

The reference includes an agents section with portraits, names, and titles in a horizontally browsable layout. 

### **Simple, clean implementation**

Use native horizontal snap, not a heavy JS carousel.

.agents-row {  
 display: grid;  
 grid-auto-flow: column;  
 grid-auto-columns: minmax(240px, 300px);  
 gap: 22px;  
 overflow-x: auto;  
 padding-bottom: 10px;  
 scroll-snap-type: x mandatory;  
 scrollbar-width: none;  
}

.agents-row::-webkit-scrollbar {  
 display: none;  
}

.agent-card {  
 scroll-snap-align: start;  
 border-radius: var(--radius-md);  
 overflow: hidden;  
 background: rgba(255,255,255,0.045);  
 border: 1px solid var(--border);  
 transition:  
   transform var(--dur-fast) var(--ease-premium),  
   box-shadow var(--dur-fast) var(--ease-premium);  
}

.agent-card:hover {  
 transform: translateY(-8px);  
 box-shadow: var(--shadow);  
}

.agent-card img {  
 width: 100%;  
 aspect-ratio: 4 / 5;  
 object-fit: cover;  
}

.agent-body {  
 padding: 18px 18px 20px;  
}

.agent-name {  
 font-family: var(--font-display);  
 font-size: 1.45rem;  
 color: var(--text);  
 line-height: 1.05;  
}

.agent-role {  
 margin-top: 8px;  
 font-size: 0.94rem;  
 color: var(--text-muted);  
}  
---

## **15\) Navigation/header spec**

The page visually reads like a transparent header over the hero, with the nav linking to Home, Services, Properties, About, Agents, and Contact. 

.site-header {  
 position: absolute;  
 inset: 0 0 auto 0;  
 z-index: 20;  
 padding-top: 22px;  
}

.site-header-inner {  
 width: min(100% \- (var(--gutter) \* 2), var(--container));  
 margin-inline: auto;  
 display: flex;  
 align-items: center;  
 justify-content: space-between;  
 gap: 24px;  
}

.brand {  
 font-family: var(--font-display);  
 font-size: 1.75rem;  
 line-height: 1;  
 color: var(--text);  
 text-decoration: none;  
}

.nav {  
 display: flex;  
 align-items: center;  
 gap: 24px;  
}

.nav a {  
 color: var(--text-soft);  
 text-decoration: none;  
 font-size: 0.94rem;  
 transition: color var(--dur-fast) var(--ease-premium);  
}

.nav a:hover {  
 color: var(--text);  
}

@media (max-width: 960px) {  
 .nav {  
   display: none;  
 }  
}  
---

## **16\) Motion rules, exact defaults**

Use these everywhere:

* hero fade-up offset: `40px`  
* section reveal offset: `48px`  
* hover lift: `8px`  
* image scale on hover: `1.04`  
* marquee duration: `28s` desktop, `36s` mobile  
* blur only for hero intro  
* no bouncing effects  
* no overshoot  
* no springy motion on luxury cards

### **Framer Motion standard**

transition: {  
 duration: 0.8,  
 ease: \[0.22, 1, 0.36, 1\]  
}

### **Reduced motion**

@media (prefers-reduced-motion: reduce) {  
 \*,  
 \*::before,  
 \*::after {  
   animation-duration: 0.001ms \!important;  
   animation-iteration-count: 1 \!important;  
   transition-duration: 0.001ms \!important;  
   scroll-behavior: auto \!important;  
 }  
}  
---

## **17\) Full page scaffold order**

Use this exact order because it matches the reference’s visible section hierarchy. 

1. Transparent header  
2. Hero image/video background  
3. Hero content  
4. Hero CTA  
5. Hero stats  
6. Marquee strip  
7. Services intro  
8. Services cards  
9. Why choose us cards  
10. Featured properties  
11. About split  
12. Mission / vision cards  
13. Agents row  
14. Contact CTA/footer

---

## **18\) Recommended file structure**

/src  
 /components  
   Header.tsx  
   Hero.tsx  
   TopMarquee.tsx  
   StatsRow.tsx  
   Reveal.tsx  
   SectionHeading.tsx  
   ServiceCard.tsx  
   PropertyCard.tsx  
   AgentCard.tsx  
 /styles  
   tokens.css  
   base.css  
   layout.css  
   hero.css  
   cards.css  
   marquee.css  
   header.css  
   agents.css  
 /lib  
   motion.ts  
---

## **19\) What the devs should copy directly**

This is the build standard:

* **Framework**: React \+ Framer Motion  
* **Typography**: Cormorant Garamond or Playfair for display, Inter for body  
* **Hero**: full-screen image with dark overlay, max content width \~760px  
* **Spacing**: wide luxury spacing, 96px vertical sections on desktop  
* **Marquee**: infinite CSS loop, duplicated content, masked edges  
* **Stats**: count up on intersection  
* **Cards**: rounded 22px, subtle borders, hover lift \+ image scale  
* **Agents**: horizontal snap row  
* **Motion**: cubic-bezier(0.22, 1, 0.36, 1), restrained, premium  
* **Accessibility**: reduced motion respected

---

## **20\) Final implementation note to the dev team**

Recreate the visible VistaHaven motion and layout language, not a generic real-estate template. The page clearly uses a dark luxury hero with a serif headline, body copy, CTA, counters, and a repeated social-proof marquee, followed by services, property cards, about content with repeated stats, mission/vision blocks, and an agent reel. Build the hero with a strong visual hierarchy, wide spacing, soft glassy chips, rounded cards, subtle image scaling, and smooth fade-up reveals. The marquee must be an infinite ticker, not a slider. Use one consistent easing curve across the site and keep the motion controlled and premium.

