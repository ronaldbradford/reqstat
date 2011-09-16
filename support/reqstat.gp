#!/usr/bin/gnuplot
# Gnuplot template
# sed -e "s/,/\\t/g;s/^epoch/#epoch/" reqstat.csv > reqstat.tsv
set terminal png size 1000,600
set output "reqstat.png"
set title "reqstat"
set xlabel "time"
set ylabel "count/(ms)"
set timefmt x "%s"
set xdata time
set format x "%M:%S"
plot "reqstat.tsv" u 1:3 w l title "rps", \
     "reqstat.tsv" u 1:4 w l title "avg_req (ms)", \
     "reqstat.tsv" u 1:5 w p title "last (ms)", \
     "reqstat.tsv" u 1:10 w p title "max (ms)" 
